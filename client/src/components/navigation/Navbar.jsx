import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import "../../css/navigation/Navbar.css";

function Navigationbar() {
  const navigate = useNavigate();
  const [isDropdownVisible, setDropdownVisible] = useState(false);

  const handleLogout = () => {
    localStorage.removeItem("auth");
    navigate("/login/");
  };

  const toggleDropdown = () => {
    setDropdownVisible(!isDropdownVisible);
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
            onClick={toggleDropdown} // Toggle dropdown visibility on click
          />
          <ul className={`dropdown ${isDropdownVisible ? "visible" : ""}`}>
            <li><a href="#">Profile</a></li>
            <li><button onClick={handleLogout}>Logout</button></li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Navigationbar;
