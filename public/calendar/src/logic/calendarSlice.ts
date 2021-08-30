import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { RootState } from './store';

import { getISOWeek, getMonth, getYear, startOfWeek, addWeeks, format, addDays, endOfWeek, isMonday, differenceInHours, differenceInWeeks, getUnixTime, fromUnixTime } from "date-fns";
import Day from '../components/Calendar/Day';
import axios from 'axios';
import differenceInDays from 'date-fns/differenceInDays';
import { OVERALL } from './types';

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
    status: string
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
    completed: Array<HabitCompleted>
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
                completed: HABITS[key].completed
            };
            habits.push(habit);
        })


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
                let DayDate = addDays(WeekDate, l); // Get current day by adding the number of days inside the week

                let inMonth = true;
                if (parseInt(format(DayDate, "M")) != current.month + 1) { // +1 required as computers store the first month as zero, but humans store the first number as one
                    inMonth = false;
                }

                let overall = OVERALL.Error;

                // Loop through the habits to work out the completion status
                for(var x = 0; x < habits.length; x++) {
                    const data = habits[x];
                    if(data.frequency[parseInt(format(DayDate, "i")) - 1] == false) {
                        overall = OVERALL.Empty;
                    } else if (data.frequency[parseInt(format(DayDate, "i")) - 1] == true) {
                        overall = OVERALL.Uncompleted;
                        
                        // Check if the habit has been completed
                        Object.keys(data.completed).forEach((key: any) => {
                            // Timestamp
                            const time = data.completed[key].time_completed;
                            if(differenceInHours(DayDate, fromUnixTime(parseInt(time))) > 24) {
                                overall = OVERALL.Completed;
                            }
                        });
                    }
                }

                // uncompleted or completed
                let Completed: HabitStatus = {
                    overall: overall,
                    progress: [],
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