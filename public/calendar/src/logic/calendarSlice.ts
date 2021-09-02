import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { RootState } from './store';

import { getISOWeek, getMonth, getYear, startOfWeek, addWeeks, format, addDays, endOfWeek, isMonday, differenceInHours, differenceInWeeks, getUnixTime, fromUnixTime, isBefore, isAfter } from "date-fns";
import Day from '../components/Calendar/Day';
import axios from 'axios';
import differenceInDays from 'date-fns/differenceInDays';
import { OVERALL } from './types';
import { Uncompleted } from '../components/Calendar/Completion';

const API_ENDPOINT = "/app/api/habits/completed.php";

// Calander Interfaces
interface Calander {
    weeks: Array<Week>
}

interface Week {
    number: number,
    days: Array<Day>
}


interface Day {
    dateNumber: number,
    inMonth: boolean,
    day: number,
    habits: HabitStatus
}


interface HabitStatus {
    overall: OVERALL,
    progress: Array<HabitProgress>
}

interface HabitProgress {
    id: number, 
    name: string, 
    status: OVERALL,
}

interface CalendarState {
    current: {
        month: number,
        year: number
    },
    status: string,
    calander: Calander,
    habits: Array<Habit>
}

interface Habit {
    id: number,
    name: string,
    frequency: Array<boolean>,
    completed: Array<HabitCompleted>,
    start: number
}

interface HabitCompleted {
    id: string,
    habit_id: string,
    time_completed: string
};


const initialState: CalendarState = {
    current: {
        month: null,
        year: null,
    },
    status: "loading",
    calander: null,
    habits: null
};

export const generateCalendar = createAsyncThunk(
    'calendar/fetchCalander',
    async(date: string) => {
        // Create Date
        const today = new Date(date);

        // Create Calander Object
        let calendar: Calander = {
            weeks: []
        }

        let current = {
            month: getMonth(today),
            year: getYear(today)
        };

        let habits: Array<Habit> = [];

        // Create First Day
        let FirstDay = new Date(current.year, current.month);
        FirstDay = startOfWeek(FirstDay, {weekStartsOn: 1}); // Get actual start of week
    
        
        // Create Last Day
        let LastDay = new Date(current.year, current.month + 1); // Get one month ahead
        if(isMonday(LastDay) == true) { // If the start of the next month is a monday, then you don't need to have that week added to the calendar
            LastDay = addDays(LastDay,-1);
        } else {
            LastDay = endOfWeek(LastDay, {weekStartsOn: 1});
        }

        const APIData = await axios.get("/app/api/habits/crud/read.php");
        
        // Fill out habits variable
        const HABITS = APIData.data;
        Object.keys(HABITS).forEach((key: string) => {
            var habit: Habit = {
                id: HABITS[key].id,
                name: HABITS[key].name,
                frequency: HABITS[key].frequency,
                completed: HABITS[key].completed,
                start: HABITS[key].start_date,
            };
            habits.push(habit);
        });

        for(var i = 0; i < differenceInWeeks(LastDay, FirstDay) + 1; i++) {
            // Get the monday of the current week based on the number of weeks into the month
            let WeekDate = addWeeks(FirstDay, i);
            
            // Create the week object
            let week: Week = {
                number: getISOWeek(WeekDate), // Set the week number basd based on the first day of the week
                days: []
            };

            // Loop through each day in the week (7 days a week)
            for(var l = 0; l < 7; l++) {
                console.group();

                let DayDate = addDays(WeekDate, l); // Get current day by adding the number of days inside the week

                console.log(format(DayDate, "EEEE") + " - " + format(DayDate, "PPPPpppp"));

                let inMonth = true;
                if (parseInt(format(DayDate, "M")) != current.month + 1) { // +1 required as computers store the first month as zero, but humans store the first number as one
                    inMonth = false;
                }

                let overall = OVERALL.Error; // Overall status display on the day
                let progress:Array<HabitProgress> = []; // Shown with more infomation

                // Create a variable to hold the number of OVERALL status 
                let overall_progress = {completed: 0, uncompleted: 0, empty: 0, error: 0};
                
                /* Loop through the habits to determin what habits are due */
                for(var x = 0; x < habits.length; x++) {
                    console.group();
                    const habit = habits[x]; // Save current habit for future reference

                    console.log("Habit Name: " + habit.name + "\nHabit Start: " + format(fromUnixTime(habit.start), "Pp") + "\nCurrent Date: " + format(DayDate, "Pp"));

                    // Check if the habit start date is after the current date
                    if(isAfter(DayDate, fromUnixTime(habit.start))) {
                        // Check if the current date is before the computer date (to prevent showing uncompletes in the future)
                        if(isBefore(DayDate, new Date())) {
                            // Check if the habit is due today
                            const CurrentDayNumber = parseInt(format(DayDate, "i")) - 1;
                            
                            // Checks that the parse int worked sucessfully
                            if(!isNaN(CurrentDayNumber)) { 
                                if(habit.frequency[CurrentDayNumber] == true) { // Means that the habit is due today
                                    var completed = false;

                                    // Check if the habit has been completed today by looping through every habit_complete and comparing the current day timestamp and the recorded timestamp
                                    for(const habit_key in habit.completed) { // Using werid for loop because habit.completed isn't an array, instead a group of objects
                                        const habit_completed = habit.completed[habit_key];

                                        // Check that the habit was completed on the day
                                        if(differenceInHours(fromUnixTime(parseInt(habit_completed.time_completed)), DayDate) > 0 && differenceInHours(fromUnixTime(parseInt(habit_completed.time_completed)), DayDate) < 24) {
                                            console.log("COMPLETED");
                                            completed = true;
                                        }
                                    }

                                    if(!completed) {
                                        console.log("[Output] Habit is due today - but not completed");
                                        overall_progress.uncompleted++;

                                        progress.push({id: habit.id, name: habit.name, status: OVERALL.Uncompleted})
                                    } else {
                                        overall_progress.completed++;
                                        console.log("[Output] Habit is due today - completed");

                                        progress.push({id: habit.id, name: habit.name, status: OVERALL.Completed})
                                    }
                                } else { // Means that the habit is not due today
                                    overall_progress.empty++;
                                    console.log("[Output] Habit is not due today");

                                    // If a habit has been completed, show it
                                    for(const habit_key in habit.completed) {
                                        const habit_completed = habit.completed[habit_key];
                                        
                                        let completed = false;

                                        // Check that the habit was completed on the day
                                        if(differenceInHours(fromUnixTime(parseInt(habit_completed.time_completed)), DayDate) > 0 && differenceInHours(fromUnixTime(parseInt(habit_completed.time_completed)), DayDate) < 24) {
                                            console.log("[Output] But, we found a habit completed, on this day, we should show");
                                            completed = true;
                                        }

                                        if(completed == true) {
                                            progress.push({id: habit.id, name: habit.name, status: OVERALL.CompletedWrongDay})
                                        }

                                    }
                                }
                            } else { 
                                overall_progress.error++;
                            }
                        } else {
                            console.log("[Output] Date is in the future");
                            overall_progress.empty++;
                        }

                        
                    } else {
                        overall_progress.empty++;
                        console.log("[Output] Will not display date as the habit starting is after the current date ");
                    }

                    console.groupEnd();
                }

                // Caluclate Overall
                if(overall_progress.error > 0) {
                    overall = OVERALL.Error;
                } else if (overall_progress.completed == 0 && overall_progress.uncompleted == 0) { // No habits due today
                    overall = OVERALL.Empty;
                } else if (overall_progress.uncompleted > 0) {
                    overall = OVERALL.Uncompleted;
                } else if(overall_progress.uncompleted == 0 && overall_progress.completed > 0) {
                    overall = OVERALL.Completed;
                }

                console.log(overall_progress);
                console.log(overall);
                console.groupEnd();

                // uncompleted or completed
                let Completed: HabitStatus = {
                    overall: overall,
                    progress: progress,
                };

                let day: Day = {
                    dateNumber: parseInt(format(DayDate, "dd")),
                    day: getUnixTime(DayDate),
                    inMonth: inMonth,
                    habits: Completed
                } 

                week.days.push(day);
            }

            calendar.weeks.push(week);
        }

        /*
        // Request the API to get data
        const APIData = await axios.get(API_ENDPOINT);    
        // Loop through through each week
        for(var i = 0; i < differenceInWeeks(LastDay, FirstDay) + 1; i++) {
            // Get the monday of the current week based on the number of weeks into the month
            let WeekDate = addWeeks(FirstDay, i);
    
            // Create the week object
            let week: Week = {
                number: getISOWeek(WeekDate), // Set the week number basd based on the first day of the week
                days: []
            };
    
            // Loop through each day in the week (7 days in a week)
            for(var l = 0; l < 7; l++) {
                let DayDate = addDays(WeekDate, l); // Get the current day by adding the number of days inside the week
    
                // Checks if the day is inside the selected month
                let inMonth = true;
                if (parseInt(format(DayDate, "M")) != current.month + 1) { // +1 required as computers store the first month as zero, but humans store the first number as one
                    inMonth = false;
                }

                let DayHabits:Array<Habit> = [];

                // Loop through API Data page
                for(const HabitKey in APIData.data) {
                    for(const CompletedKey in APIData.data[HabitKey].times) {
                        const APIDate = fromUnixTime(APIData.data[HabitKey].times[CompletedKey]);
                        if(differenceInHours(APIDate, DayDate) < 24 && differenceInHours(APIDate, DayDate) > 0) {
                            let Habit:Habit = {name: APIData.data[HabitKey].name, completed: true, completedID: parseInt(CompletedKey)};
                            DayHabits.push(Habit);
                        }
                    }
                }
    
                // Create Day Object
                let day: Day = {
                    dateNumber: parseInt(format(DayDate, "dd")), // Current Day
                    display: format(DayDate, "EEEE") + ", " + format(DayDate, "do") + " of " + format(DayDate, "MMM") + ", " + format(DayDate, "yyyy"),
                    inMonth: inMonth,
                    habits: DayHabits
                };
    
                // Add to the current week
                week.days.push(day);
            }
    
            // Add the week to the calender month
            calendar.weeks.push(week);
        }
    

        // Return
        return {
            calendar: calendar,
            current: current
        };*/

        return {
            calendar: calendar,
            current: current,
            habits: habits
        };    
    }
)

export const calendarSlice = createSlice({
    name: "calendar",
    initialState,
    reducers: {
        updateFilter: (state, action) => {
            console.log(action.payload);
        }
    },
    extraReducers: (builder) => {
        builder.addCase(generateCalendar.fulfilled, (state, action) => {
            state.status = "loaded";

            state.current.month = action.payload.current.month;
            state.current.year = action.payload.current.year;

            state.habits = action.payload.habits;

            state.calander = action.payload.calendar;
        })
    }
})

export const selectCurrent = (state: RootState) => state.calander.current;

export const selectCalendar = (state: RootState) => {
    return state.calander.calander;
};

export const selectStatus = (state: RootState) => {
    return state.calander.status;
};

export const selectHabits = (state: RootState) => {
    return state.calander.habits;
};

export default calendarSlice.reducer;

export const { updateFilter } = calendarSlice.actions;