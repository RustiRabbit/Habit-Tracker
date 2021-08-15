import React, { useState } from 'react';

import "../../scss/calendar.scss"

export default function Day(props) {
    // Manages display classes
    let DisplayClasses = "cal-day";
    if(props.outside == true) {
        DisplayClasses += " outside";
    }

    // Creates the habits in a list
    let Habits = props.habits.map((habit) => {
        return <li key={habit.completedID}>{habit.name}</li>
    })

    // If habits are empty, then say so
    if(Habits.length == 0) {
        Habits = <p>No goals for today</p>;
    }
    

    // Manage individual display state of day
    const [DisplayState, setDisplayState] = useState("cal-edit cal-hidden");
    const Show = () => {
        if(DisplayState == "cal-edit cal-hidden") {
            setDisplayState("cal-edit cal-show")
        }
    }

    return (
        <td onClick={Show} className={DisplayClasses}>
            <p>{props.day}</p>
            <div className={DisplayState}>
                <div className="content">
                    <div className="header">
                        <h1>{props.display}</h1>
                    </div>
                    <div className="habits">
                        <h1>Goals:</h1>
                        <ul>
                            {Habits}
                        </ul>
                    </div>
                    <button onClick={() => setDisplayState("cal-edit cal-hidden")}>Close</button>
                </div>
                
            </div>
        </td>
    )
}
