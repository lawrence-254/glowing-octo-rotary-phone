import React from 'react';
import { Link } from "react-router-dom";
import LoginForm from "../../components/forms/LoginForm"; 
import '../../css/pages/authentication/Login.css'

const Login = () => {
  return (
    <div className="login-container">
      <div className="login-row">
        {/* Left Column: Title and Intro */}
        <div className="left-column">
          <h1>TechWitter</h1>
          <p>Welcome to your tech discussion forum</p>
          <hr/>
          <p>Don't have an account?</p>
          <Link to="/register/" className="button-link">
            <button className="btn btn-outline-primary btn-lg">REGISTER</button>
          </Link>
        </div>

        {/* Right Column: Login Form */}
        <div className="right-column">
          <div className="card">
            <div className="card-body">
              <LoginForm />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;

