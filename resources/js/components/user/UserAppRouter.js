import React, {Component} from 'react';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import UserDisplay from './UserDisplay';
import UserAdd from './UserAdd';
import UserEdit from './UserEdit';

function AppRouter() {
  return (
    <Router>
      <div>
        <Route path="/admin/users" exact component={UserDisplay} />
        <Route path="/admin/users/add" component={UserAdd} />
        <Route path="/admin/users/edit/:id" component={UserEdit} />
      </div>
    </Router>
  );
}

export default AppRouter;