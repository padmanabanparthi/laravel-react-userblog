import React, { Component } from 'react';

import { BrowserRouter as Router, Route, Link } from "react-router-dom";

import AppRouter from "./UserAppRouter";

class UserApp extends Component {
    
    render() {
        return (
            <React.Fragment>
                <AppRouter />
            </React.Fragment>
        )
    }
}

export default UserApp