import React from 'react';
import { Link } from "react-router-dom";
import RegistrationForm from '../../components/forms/RegistrationForm';
import '../../css/pages/authentication/Register.css'

const Registration = () => {
  return (
    <div className="registration-container">
      <div className="registration-row">
        {/* Left Column: Title and Link to Login */}
        <div className="left-column">
          <h1>TechWitter</h1>
          <p>Welcome to your tech discussion forum</p>
          <hr />
          <p>Already have an account?</p>
          <Link to="/login/" className="link">
            login
          </Link>
        </div>

        {/* Right Column: Registration Form */}
        <div className="right-column">
          <div className="registration-card">
            <div className="registration-form-container">
              <RegistrationForm />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Registration;
