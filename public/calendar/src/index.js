import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';

import Application from "./components/Application";
import { updatePosition } from './logic/calendarSlice';
import { store } from './logic/store';

store.dispatch(updatePosition(new Date().toJSON()));

ReactDOM.render(
    <React.StrictMode>
        <Provider store={store}>
            <Application />
        </Provider>
    </React.StrictMode>,
  document.getElementById('calendar')
);