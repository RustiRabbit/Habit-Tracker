import React from 'react';

import "../../scss/calendar.scss"

export default function Day(props) {
    return (
        <td className="cal-day">
            <p>{props.day}</p>
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