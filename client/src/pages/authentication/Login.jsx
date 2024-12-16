import React from 'react';
import { Link } from "react-router-dom";
import LoginForm from "../../components/forms/LoginForm"; 
import '../../css/pages/authentication/Login.css'

const Login = () => {
  return (
    <div className="login-container">
        {/* Left Column: Title and Intro */}
        <div className="left-column">
         <div className="left-col-container">
         <h1>TechWitter</h1>
          <p>Welcome to your tech discussion forum</p>
          <hr/>
          <p>Don't have an account?</p>
          <Link to="/register/" className="button-link">
            <button className="btn btn-outline-primary btn-lg">REGISTER</button>
          </Link>
         </div>
        </div>

        {/* Right Column: Login Form */}
        <div className="right-column">
          <div className="cards">
            <div className="card-body">
              <LoginForm />
            </div>
          </div>
        </div>
    </div>
  );
};

export default Login;

