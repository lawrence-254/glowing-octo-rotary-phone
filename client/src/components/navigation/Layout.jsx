import React from "react";
import Navigationbar from "./Navbar";
import "./Layout.css";
import "../../css/navigation/Layout.css";

function Layout(props) {
  return (
    <>
      <Navigationbar />
      <div className="container">{props.children}</div>
    </>
  );
}

export default Layout;
