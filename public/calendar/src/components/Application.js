import React from 'react';
import { connect, useSelector } from 'react-redux';
import Calender from './Calendar/Calendar';
import Navigation from './Navigation';

import { selectStatus } from '../logic/calendarSlice';

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
                <Calendar />
            </div>
        )
    }


}


