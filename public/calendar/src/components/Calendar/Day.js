import React from 'react';

import "../../scss/calendar.scss"

export default function Day(props) {
    const Habits = props.habits.map((habit) => {
        return <li key={habit.completedID}>{habit.name}</li>
    })
    return (
        <td className="cal-day">
            <p>{props.day}</p>
            <ul>
                {Habits}
            </ul>
        </td>
    )
}

export function DayOutsideMonth(props) {
    return (
        <td className="cal-day outside">
            <p>{props.day}</p>
        </td>
    )
}