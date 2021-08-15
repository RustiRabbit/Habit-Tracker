import React from 'react';
import { useSelector } from 'react-redux';
import { selectCalendar } from '../../logic/calendarSlice';
import Day, {DayOutsideMonth} from './Day';

export default function Calender() {
    const Data = useSelector(selectCalendar);

    const Elements = Data.weeks.map((week) => {
        const days = week.days.map((day) => {
            if(day.inMonth == false) {
                return (
                    <DayOutsideMonth key={day.dateNumber} day={day.dateNumber} habits={day.habits}/>
                )
            }
            return (
                <Day key={day.dateNumber} day={day.dateNumber} habits={day.habits}/>
            )
        })

        return (
            <tr key={week.number}>
                {days}
            </tr>   
        )
    })

    return (
        <div>
            <table>
                <thead>
                    <tr>
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