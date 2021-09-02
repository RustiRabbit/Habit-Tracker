import React from 'react';
import { OVERALL } from '../../logic/types';
import { Completed, Empty, Uncompleted } from './Completion';

export default function HabitDisplay(props) {
    const data = props.progress;

    const Generate = () => {
        let Completed = [];
        let Uncompleted = [];

        for(var i = 0; i < data.length; i++) {
            if(data[i].status == OVERALL.Completed) {
                Completed.push(<Habit data={data[i]} />);
            } else if(data[i].status == OVERALL.Uncompleted) {
                Uncompleted.push(<Habit data={data[i]} />);
            }
        }

        let CompletedElement;
        let UncompletedElement;

        if(Completed.length != 0)  {
            CompletedElement = <div><h2>Completed:</h2>{Completed}</div>
        }

        if(Uncompleted.length != 0)  {
            UncompletedElement = <div><h2>Uncompleted:</h2>{Uncompleted}</div>
        }

        return {
            Uncompleted: UncompletedElement,
            Completed: CompletedElement
        }
    }

    return (
        <div className="habits">
            {Generate().Uncompleted}
            {Generate().Completed}
        </div>
    )
}

function Habit(props) {
    const data = props.data;

    let Display = <Error />;

    if(data.status == OVERALL.Completed) {
        Display = <Completed />;
    } else if(data.status == OVERALL.Uncompleted) {
        Display = <Uncompleted />;
    } else if(data.status == OVERALL.Empty) {
        Display = <Empty />;
    }
    
    return (
        <div>
            {Display}
            <p>{data.name}</p>
        </div>
    );
}