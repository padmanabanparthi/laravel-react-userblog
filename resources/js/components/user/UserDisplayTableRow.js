import React, {Component} from  'react'
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css';

class UserDisplayTableRow extends Component{
    constructor(props){
        super(props)
        this.deleteRow = this.deleteRow.bind(this);
        //alert(this.props.user.name)
    }
    deleteRow () {
        confirmAlert({
          title: 'Confirm to submit',
          message: 'Are you sure to do this.',
          buttons: [
            {
              label: 'Yes',
              onClick: () => {
                alert("deleted "+this.props.user.id)
              }
            },
            {
              label: 'No',
              onClick: () => alert('Click No')
            }
          ]
        });
      };

    render(){
        return(
            <tr>
                <td>1</td>
                <td>
                    <ProfileImage userimage={this.props.user.profile_image}/>
                </td>
                <td>{this.props.user.name}</td>
                <td>{this.props.user.email}</td>
                <td>{this.props.user.usertype}</td>
                <td>{this.props.user.created_at}</td>
                <td>
                    <Link to={"/admin/users/edit/"+this.props.user.id} className="btn btn-info btn-sm hvr-glow"><i className="fa fa-edit" aria-hidden="true"></i> </Link>
                    <button onClick={this.deleteRow} className="btn btn-danger btn-sm hvr-glow"><i className="fa fa-trash"></i></button>
                </td>
            </tr>
        );
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

export default UserDisplayTableRow