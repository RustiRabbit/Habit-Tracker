import React from 'react';

export default function HabitSelect() {
    return (
        <select defaultValue="-1">
            <option value="-1">Show All Habits</option>
            <option value="1">Go for a run</option>
        </select>
    )
}