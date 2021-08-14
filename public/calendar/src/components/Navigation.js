import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { createCalander, selectCurrent, updatePosition } from '../logic/calendarSlice';

import { format } from "date-fns";

import "../scss/navigation.scss";

export default function Navigation() {
    const Dispatch = useDispatch();
    const Current = useSelector(selectCurrent);
    const Selector = useSelector(createCalander);
    const Display = format(new Date(Current.year, Current.month), "MMMM, yyyy")

    const Decrement = () => {
        Dispatch(updatePosition(new Date(Current.year, Current.month - 1).toJSON()))

    }

    const Increment = () => {
        Dispatch(updatePosition(new Date(Current.year, Current.month + 1).toJSON()))
    }

    const Today = () => {
        Dispatch(updatePosition(new Date().toJSON()));
    }

    return (
        <div className="cal-nav">
            <div>
                <button onClick={Decrement}>Decrement</button>
            </div>
            <div className="cal-title">
                <p>{Display}</p>
                <button onClick={Today}>Today</button>
            </div>

            <div>
                <button onClick={Increment}>Increment</button>
            </div>
        </div>
    )
}