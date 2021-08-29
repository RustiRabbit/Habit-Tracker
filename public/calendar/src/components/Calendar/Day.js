import React, { useState } from 'react';
import { OVERALL } from '../../logic/types';
import { Completed, Empty, Uncompleted, Error } from './Completion';

export default function Day(props) {
    let Element;

    if(props.habit.overall == OVERALL.Completed) {
        Element = <Completed />;
    } else if (props.habit.overall == OVERALL.Uncompleted) {
        Element = <Uncompleted />;
    } else if (props.habit.overall == OVERALL.Empty) {
        Element = <Empty />;
    } else {
        Element = <Error />;
    }

    return (
       <td>
           <div>
                <p>{props.day}</p>
                <div className="status">
                    {Element}
                </div>
            </div>
        </td>
   )
}
