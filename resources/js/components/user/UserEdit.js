import React, {Component} from "react"
import { BrowserRouter as Router, Route, Link, Redirect } from "react-router-dom";
import MyGlobleSetting from "../MyGlobleSetting";

class UserEdit extends Component{
    constructor(props){
        super(props);
        this.initialState = { usertype:null , name: '', email: '', status: '' }
        this.validationErrors = { usertypeError:null , nameError: '', emailError: '', statusError:'' }

        this.state = { 
            usertype:null , name: '', email: '', status: '',
            usertypeError:null , nameError: '', emailError: '', statusError: '',
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

    componentDidMount(){
        axios.get(MyGlobleSetting.url + '/api/users/'+this.props.match.params.id+'/edit')
        .then(response => {
            console.log(response.data.user);
            this.setState({ usertype: response.data.user.usertype, name: response.data.user.name, email: response.data.user.email, status: response.data.user.status });
        })
        .catch(function (error) {
          console.log(error);
        })
    }

    handleSubmit (event) {
        event.preventDefault();
        //alert(this.state.usertype+","+this.state.name+","+this.state.email);
        const user = {
            usertype: this.state.usertype,
            name: this.state.name,
            email: this.state.email,
            status: this.state.status
        };
        
        const url = MyGlobleSetting.url+'/api/users/'+this.props.match.params.id
        axios.patch(url, user)
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
                        <select className="form-control" name="usertype" id="usertype" value={this.state.usertype} onChange={this.handleChange}>
                            <option value='admin'>Admin</option>
                            <option value='user'>User</option>
                        </select>
                        {this.state.usertypeError}
                    </div>
                    <div className="form-group">
                        <label htmlFor="name">Name:</label>
                        <input type="text" className="form-control" name="name" id="name" value={this.state.name} onChange={this.handleChange}/>
                        {this.state.nameError}
                    </div>
                    <div className="form-group">
                        <label htmlFor="email">Email address:</label>
                        <input type="email" className="form-control" name="email" id="email" value={this.state.email} autoComplete="nope" onChange={this.handleChange}/>
                        {this.state.emailError}
                    </div>
                    <div className="form-group">
                        <label htmlFor="usertype">Status:</label>
                        <select className="form-control" name="status" id="status" value={this.state.status} onChange={this.handleChange}>
                            <option value="1" >Active</option>
                            <option value="0" >Deactive</option>
                        </select>
                        {this.state.statusError}
                    </div>
                    
                    <button type="submit" className="btn btn-primary hvr-glow">Update</button>
                </form>
                
                </div>
            </React.Fragment>
        )
    }
}

export default UserEdit