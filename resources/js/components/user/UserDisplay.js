import React, {Component} from 'react';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import axios from 'axios';
import Pagination from "react-js-pagination";

import MyGlobleSetting from '../MyGlobleSetting';
import UserDisplayTableRow from './UserDisplayTableRow';

class UserDisplay extends Component {
  constructor(props) {
    super(props);
    this.state = { 
        users: [],
        otherInfo:'',
        activePage: 1,
        itemsCountPerPage: 5,
        totalItemsCount: 2
      };
      this.handlePageChange = this.handlePageChange.bind(this)
  }
  
  handlePageChange(pageNumber) {
    console.log('active page is ${pageNumber}');
    //this.setState({activePage: pageNumber});
    const url = MyGlobleSetting.url+'/api/users?page='+pageNumber
    axios.get(url)
    .then(response=>{
      this.setState({
        users:response.data.data,
        otherInfo: response.data,
        activePage: response.data.current_page
      })
    })
    this.handlePageChange = this.handlePageChange.bind(this)
  }

  // Code is invoked after the component is mounted/inserted into the DOM tree.
  componentDidMount() {
    const url = MyGlobleSetting.url+'/api/users'

    axios.get(url)
    .then(response=>{
      this.setState({
        users:response.data.data,
        otherInfo: response.data
      })
    })
    // this is react deafult ajax call
    // fetch(url)
    //   .then(result => result.json())
    //   .then(result => {
    //     this.setState({
    //       users: result.data,
    //       otherInfo: result,
    //     })
    //   })
  }

  tabRow(){
    return this.state.users.map((user, index) => {
    return <UserDisplayTableRow user={user} key={index} />;
    });
  }

  render() {
    //var users = this.state.users;
    var otherInfo = this.state.otherInfo;
    console.log(this.state.users);

    return (
            <React.Fragment>
              <div className="box-tools pull-right" style={{ paddingTop:'10px', paddingBottom:'10px' }}>
                <Link to="/admin/users/add" className="btn btn-success btn-sm hvr-glow"><i className="fa fa-plus" aria-hidden="true"></i> Add New</Link>
                  
              </div>
              <table className="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  {this.tabRow()}
                </tbody>
              </table>
              <div aria-label="Page navigation example">
                <Pagination
                  activePage={this.state.activePage}
                  itemsCountPerPage={otherInfo.per_page}
                  totalItemsCount={otherInfo.total}
                  onChange={this.handlePageChange.bind(this)}
                  itemClass='page-item'
                  linkClass='page-link'
                />
              </div>
              
            </React.Fragment>            
          )
  }
}

export default UserDisplay;