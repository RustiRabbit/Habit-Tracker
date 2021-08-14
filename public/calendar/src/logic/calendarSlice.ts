import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { RootState } from './store';

import { getMonth, getYear } from "date-fns";

interface CalendarState {
    current: {
        month: Number,
        year: Number
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

export default calendarSlice.reducer;