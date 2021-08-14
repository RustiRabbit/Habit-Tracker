import React from 'react';
import Calendar from './Calendar/Calendar';
import Navigation from './Navigation';

class Application extends React.Component {
    constructor(props) {
        super(props);

        
    }

    render() {
        return (
            <div>
                <Navigation />
                <Calendar />
            </div>
        );
    }
}

export default Application;