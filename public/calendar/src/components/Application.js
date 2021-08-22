import React from 'react';
import { useSelector } from 'react-redux';
import Navigation from './Navigation';

import { selectStatus } from '../logic/calendarSlice';
import Calender from './Calendar/Calendar';

export default function Application(props) {
    const Loaded = useSelector(selectStatus);

    if(Loaded == "loading") {
        return (
            <p>Loading Calendar</p>
        )
    } else {
        return (
            <div>
                <Navigation />
                <Calender />
            </div>
        )
    }


}


