import React from "react";
import Navigationbar from "./Navbar";

function Layout(props){
    return(
        <>
        <Navigationbar/>
        <div className='container m-5'>{props.children}</div>
        </>
    )
}

export default Layout;