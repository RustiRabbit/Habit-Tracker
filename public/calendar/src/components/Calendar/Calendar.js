import React from 'react';
import { useSelector } from 'react-redux';
import { createCalander } from '../../logic/calendarSlice';
import Day, {DayOutsideMonth} from './Day';

import "../../scss/calendar.scss";

export default function Calendar() {
    const Data = useSelector(createCalander);

    const Elements = Data.weeks.map((week) => {
        const days = week.days.map((day) => {
            if(day.inMonth == false) {
                return (
                    <DayOutsideMonth key={day.dateNumber} day={day.dateNumber}/>
                )
            }
            return (
                <Day key={day.dateNumber} day={day.dateNumber} />
            )
        })

        return (
            <tr key={week.number}>
                {days}
            </tr>
        )
    })

    return (
        <div className="cal-body">
            <table>
                <thead>
                    <tr className="cal-title">
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                </thead>
                <tbody>
                    {Elements}
                </tbody>
            </table>
        </div>
    );
}