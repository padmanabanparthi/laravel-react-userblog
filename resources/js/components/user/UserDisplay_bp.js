import React, {Component} from 'react';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import axios from 'axios';
import Pagination from "react-js-pagination";

import MyGlobleSetting from '../MyGlobleSetting';
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css';

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
      this.confrimSubmit = this.confrimSubmit.bind(this)
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

  confrimSubmit (e) {
    e.preventDefault();
    confirmAlert({
      title: 'Confirm to submit',
      message: 'Are you sure to do this.',
      buttons: [
        {
          label: 'Yes',
          onClick: () => {
            alert("deleted")
          }
        },
        {
          label: 'No',
          onClick: () => alert('Click No')
        }
      ]
    });
  };

  render() {
    //var users = this.state.users;
    var otherInfo = this.state.otherInfo;
    console.log(this.state.users);

    const result = this.state.users.map((user, index) => {
      return (
        <tr key={index}> 
          <td>{index+1}</td>
          <td>
              <ProfileImage userimage={user.profile_image}/>
          </td>
          <td>{user.name}</td>
          <td>{user.email}</td>
          <td>{user.usertype}</td>
          <td>{user.created_at}</td>
          <td>
            
            <form onSubmit={this.confrimSubmit}>
              <Link to={"/admin/users/edit/"+user.id} className="btn btn-info btn-sm hvr-glow"><i className="fa fa-edit" aria-hidden="true"></i> </Link>
              <button type="submit" title="Delete" className="btn btn-danger btn-sm hvr-glow"><i className="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
      )
    })

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
                  {result}
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

function ProfileImage(props) {
  var imgStyle = {
    width:'80px'
  };
  
  if (props.userimage) {
    var img = '/images/profile_images/'+props.userimage
    return <img src={img} style={ imgStyle }/>
  } else {
    return ''
  }
}

export default UserDisplay;