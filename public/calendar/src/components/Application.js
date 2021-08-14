import React from 'react';
import Calender from './Calendar/Calendar';
import Navigation from './Navigation';

class Application extends React.Component {
    constructor(props) {
        super(props);

        
    }

    render() {
        return (
            <div>
                <Navigation />
                <Calender />
            </div>
        );
    }
}

export default Application;