import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { RootState } from './store';

import { getISOWeek, getMonth, getYear, startOfWeek, addWeeks, format, addDays, endOfWeek, isMonday, differenceInDays, differenceInWeeks } from "date-fns";
import Day from '../components/Calendar/Day';

interface CalendarState {
    current: {
        month: number,
        year: number
    }
}

const initialState: CalendarState = {
    current: {
        month: null,
        year: null,
    }
};

export const calendarSlice = createSlice({
    name: "calendar",
    initialState,
    reducers : {
        updatePosition: (state, action) => {
            // Set Current Dates
            const today = new Date(action.payload);

            state.current.month = getMonth(today);
            state.current.year = getYear(today);
        },
    }
})

export const { updatePosition } = calendarSlice.actions;

export const selectCurrent = (state: RootState) => state.calander.current;

// Create Calander
interface Calander {
    weeks: Array<Week>
}

interface Week {
    number: number,
    days: Array<Day>
}

interface Day {
    dateNumber: number,
    inMonth: boolean
}

// This function creates the calendar object that React can use to display the calendar
export const createCalander = (state: RootState) => {
    let calendar: Calander = {
        weeks: []
    }

    // Create First Day
    let FirstDay = new Date(state.calander.current.year, state.calander.current.month);
    FirstDay = startOfWeek(FirstDay, {weekStartsOn: 1}); // Get actual start of week
    
    // Create Last Day
    let LastDay = new Date(state.calander.current.year, state.calander.current.month + 1); // Get one month ahead
    if(isMonday(LastDay) == true) { // If the start of the next month is a monday, then you don't need to have that week added to the calendar
        LastDay = addDays(LastDay,-1);
    } else {
        LastDay = endOfWeek(LastDay, {weekStartsOn: 1});
    }

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
            if (parseInt(format(DayDate, "M")) != state.calander.current.month + 1) { // +1 required as computers store the first month as zero, but humans store the first number as one
                inMonth = false;
            }

            // Create Day Object
            let day: Day = {
                dateNumber: parseInt(format(DayDate, "dd")), // Current Day
                inMonth: inMonth
            };

            // Add to the current week
            week.days.push(day);
        }

        // Add the week to the calender month
        calendar.weeks.push(week);
    }

    return calendar;
};

export default calendarSlice.reducer;