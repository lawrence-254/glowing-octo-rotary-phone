import React from "react";
import { useNavigate } from "react-router-dom";
import "./Navigationbar.css"; 
import "../../css/navigation/Navbar.css";

function Navigationbar() {
  const navigate = useNavigate();
  const handleLogout = () => {
    localStorage.removeItem("auth");
    navigate("/login/");
  };

  return (
    <nav className="navbar">
      <div className="navbar-container">
        <a href="#home" className="navbar-brand">TechWitter</a>
        <div className="navbar-profile">
          <img
            src="#"
            alt="User Avatar"
            className="navbar-avatar"
          />
          <ul className="dropdown">
            <li><a href="#">Profile</a></li>
            <li><button onClick={handleLogout}>Logout</button></li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Navigationbar;


