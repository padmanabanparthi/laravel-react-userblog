import React, { Component } from 'react';

import { BrowserRouter as Router, Route, Link } from "react-router-dom";

import AppRouter from "./AppRouter";
import UserDisplay from "./UserDisplay";

class App extends Component {
    
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                          <AppRouter />
                          <UserDisplay />
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default App