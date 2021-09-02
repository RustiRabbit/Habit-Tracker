import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { selectCalendar, selectCurrent, generateCalendar } from '../logic/calendarSlice';

import HabitSelect  from './HabitSelect';

import { format } from "date-fns";

import "../scss/navigation.scss";

export default function Navigation() {
    const Dispatch = useDispatch();
    const Current = useSelector(selectCurrent);
    const Selector = useSelector(selectCalendar);
    const Display = format(new Date(Current.year, Current.month), "MMMM, yyyy")

    const Decrement = () => {
        Dispatch(generateCalendar(new Date(Current.year, Current.month - 1).toJSON()))
    }

    const Increment = () => {
        Dispatch(generateCalendar(new Date(Current.year, Current.month + 1).toJSON()))
    }

    const Today = () => {
        Dispatch(generateCalendar(new Date().toJSON()));
    }

    return (
        <div className="nav">
            <div className="left">
                <div onClick={() => Decrement()}>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                </div>
                <div onClick={() => Today()}>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V10h16v11zm0-13H4V5h16v3z"/></svg>
                </div>
                <div onClick={() => Increment()}>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8-8-8z"/></svg>
                </div>
            </div>
            <div className="center">
                <h1>{Display}</h1>
            </div>
            <div className="right">   
                <HabitSelect />
            </div>
        </div>
    )
}