import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { selectHabits, updateFilter } from '../logic/calendarSlice';

export default function HabitSelect() {
    const Habits = useSelector(selectHabits);
    const Dispatch = useDispatch();

    if(Habits == null) {
        return (
            <p>Null</p>
        );
    }

    const [selected, setSelected] = useState("-1");

    const Elements = Habits.map((habit) => {
        return (
            <option value={habit.id} key={habit.id}>{habit.name}</option>
        )
    })

    const handleChange = (e) => {
        setSelected(e.target.value);
        Dispatch(updateFilter(e.target.value));
    }
    

    return (
        <select value={selected} onChange={e => handleChange(e)}>
            <option value="-1">All Habits</option>
            {Elements}
        </select>
    )
}