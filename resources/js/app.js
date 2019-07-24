require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';

import UserApp from "./components/user/UserApp";

if (document.getElementById('userapp')) {
    ReactDOM.render(<UserApp />, document.getElementById('userapp'));
}

