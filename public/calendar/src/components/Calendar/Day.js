import format from 'date-fns/format';
import fromUnixTime from 'date-fns/fromUnixTime';
import React, { useEffect, useState } from 'react';
import { OVERALL } from '../../logic/types';
import Close from './Close';
import { Completed, Empty, Uncompleted, Error} from './Completion';

export default function Day(props) {
    const [display, setDisplay] = useState("popup hide");
    
    let HabitStatusElement;

    if(props.habits.overall == OVERALL.Uncompleted) {
        HabitStatusElement = <Uncompleted />;
    } else if(props.habits.overall == OVERALL.Completed) {
        HabitStatusElement = <Completed />;
    } else if(props.habits.overall == OVERALL.Empty) {
        HabitStatusElement = <Empty />;
    } else if(props.habits.overall == OVERALL.Error) {
        HabitStatusElement = <Error />;
    } else {
        HabitStatusElement = <Error />;
    }

    const Show = () => {
        if(display == "popup hide") {
            setDisplay("popup show");
        }
    }

    const Display = {
        Short: format(fromUnixTime(props.day), "EEEE"),
        Long: format(fromUnixTime(props.day), "do") + " of " + format(fromUnixTime(props.day), "MMMM") + ", " + format(fromUnixTime(props.day), "yyyy")
    };

    let Habits = props.habits.progress.map((habit) => <HabitDisplay key={habit.id} habit={habit} />)

    return (
        <td onClick={Show}>
            <div className="day">
                <p>{props.dateNumber}</p>
                <div className="status">
                    {HabitStatusElement}
                </div>
                <div className={display}>
                    <div className="popup-bg">
                        <div className="top">
                            <h1>{Display.Short}</h1>
                            <h3>{Display.Long}</h3>
                            <div onClick={() => setDisplay("popup hide")}>
                                <Close />
                            </div>
                        </div>
                        <div className="habits">
                           {Habits}
                        </div>
                    </div>  
                </div>
            </div>
        </td>
    );
}

function HabitDisplay(props) {
    var Status;

    if(props.habit.status == OVERALL.Completed) {
        Status = <Completed />;
    } else if(props.habit.status == OVERALL.Uncompleted) {
        Status = <Uncompleted />;
    }

    return (
        <div>
            {Status}
            <h2>{props.habit.name}</h2>
        </div>
    )
}