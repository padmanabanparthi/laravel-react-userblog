import React,{ Component } from "react";
import { BrowserRouter as Router, Route, Link, Redirect, withRouter } from "react-router-dom";
import axios from 'axios';

import MyGlobleSetting from "../MyGlobleSetting"

class UserAdd extends Component{
    constructor(props){
        super(props);
        
        this.initialState = { usertype:null , name: '', email: '', password:'', password_confirmation:'' }
        this.validationErrors = { usertypeError:null , nameError: '', emailError: '', passwordError:'', password_confirmationError:'' }

        this.state = { 
            usertype:null , name: '', email: '', password:'', password_confirmation:'', 
            usertypeError:null , nameError: '', emailError: '', passwordError:'', password_confirmationError:'' , 
            redirect: false
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange (event) {
        const { name, value } = event.target
        this.setState({
          [name]: value,
        })
    }

    handleSubmit (event) {
        event.preventDefault();
        //alert(this.state.usertype+","+this.state.name+","+this.state.email);
        const user = {
            usertype: this.state.usertype,
            name: this.state.name,
            email: this.state.email,
            password: this.state.password,
            password_confirmation: this.state.password_confirmation
        };
        
        const url = MyGlobleSetting.url+'/api/users'
        axios.post(url, user)
          .then(res => {
            console.log(res.data);
            if (res.data.status==="fail") {
                //alert("fail");
                this.setState(this.validationErrors)
                if (res.data.msg.usertype) {
                    this.setState({ usertypeError: <p className="error">{res.data.msg.usertype[0]}</p> })  
                }
                if (res.data.msg.name) {
                    this.setState({ nameError: <p className="error">{res.data.msg.name[0]}</p> })  
                }
                if (res.data.msg.email) {
                    this.setState({ emailError: <p className="error">{res.data.msg.email[0]}</p> })  
                }
                if (res.data.msg.password) {
                    this.setState({ passwordError: <p className="error">{res.data.msg.password[0]}</p> })  
                }
                if (res.data.msg.password_confirmationError) {
                    this.setState({ password_confirmationError: <p className="error">{res.data.msg.password[0]}</p> })  
                }
                
            } else {
                alert("success");
                this.setState(this.initialState)
                this.setState({ redirect: true })
            }
            //console.log(res.data.msg.name[0]);
          })
      }

    render(){
        const { redirect } = this.state;
        if (redirect) {
            return <Redirect to='/admin/users'/>;
          }
        return(
            <React.Fragment>
                <div className="pull-right" style={{paddingTop:"10px",paddingBottom:"10px"}}>
                    <Link to="/admin/users/" className="btn btn-success btn-sm hvr-glow"><i className="fa fa-long-arrow-left" aria-hidden="true"></i> Back</Link>
                </div>

                <div className="clearfix" style={{clear:"both"}}>
                    <form onSubmit={this.handleSubmit} >
                        <div className="form-group">
                            <label htmlFor="usertype">User type:</label>
                            <select className="form-control" name="usertype" id="usertype" onChange={this.handleChange}>
                                <option value=''>Select</option>
                                <option value='admin'>Admin</option>
                                <option value='user'>User</option>
                            </select>
                            {this.state.usertypeError}
                        </div>
                        <div className="form-group">
                            <label htmlFor="name">Name:</label>
                            <input type="text" className="form-control" name="name" id="name" onChange={this.handleChange}/>
                            {this.state.nameError}
                        </div>
                        <div className="form-group">
                            <label htmlFor="email">Email address:</label>
                            <input type="email" className="form-control" name="email" id="email" autoComplete="nope" onChange={this.handleChange}/>
                            {this.state.emailError}
                        </div>
                        <div className="form-group">
                            <label htmlFor="pwd">Password:</label>
                            <input type="password" className="form-control" name="password" id="pwd" autoComplete="new-password" onChange={this.handleChange}/>
                            {this.state.passwordError}
                        </div>
                        <div className="form-group">
                            <label htmlFor="cpwd">Confirm Password:</label>
                            <input type="password" className="form-control" name="password_confirmation" id="cpwd" autoComplete="new-password" onChange={this.handleChange}/>
                            {this.state.password_confirmationError}
                        </div>
                        
                        <button type="submit" className="btn btn-primary hvr-glow">Add</button>
                    </form>
                </div>
            </React.Fragment>
        )
    }
}

export default UserAdd