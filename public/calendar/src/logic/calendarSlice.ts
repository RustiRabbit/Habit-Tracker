import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { RootState } from './store';

import { getISOWeek, getMonth, getYear, startOfWeek, addWeeks, format, addDays } from "date-fns";

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
    dateNumber: number 
}

export const createCalander = (state: RootState) => {
    let calendar: Calander = {
        weeks: []
    }

    const weekStart = getISOWeek(new Date(state.calander.current.year, state.calander.current.month));
    const weekEnd = getISOWeek(new Date(state.calander.current.year, state.calander.current.month+1));

    const numberOfWeeks = weekEnd - weekStart;
    //console.log(format(startOfWeek(new Date(state.calander.current.year, state.calander.current.month), {weekStartsOn: 1}), "d, MMM"));


    for(var i = 0; i < numberOfWeeks; i++) {
        const weekNumber = weekStart + i;
        let week: Week = {
            number: weekNumber,
            days: []
        };

        // Get first day of week
        let FirstDay = new Date(state.calander.current.year, 0, 1); // Set to this year
        FirstDay = addWeeks(FirstDay, weekNumber);
        FirstDay = startOfWeek(FirstDay, {weekStartsOn: 1});

        for(var dayNumber = 0; dayNumber < 7; dayNumber++) {
            let day: Day = {
                dateNumber: parseInt(format(addDays(FirstDay, dayNumber), 'dd'))
            }

            week.days.push(day);
        }

        calendar.weeks.push(week);
    }

    return calendar;
};

export default calendarSlice.reducer;