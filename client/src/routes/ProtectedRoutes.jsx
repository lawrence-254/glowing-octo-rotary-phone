import React from "react";
import {Navigate} from "react-router-dom";
import {getUser} from "../hooks/user.actions"

const ProtectedRoutes = ({children}) => {
  const {user} = getUser()
  return user.account ? <>{children}</> : <Navigate to="/login/" />
  
}

export default ProtectedRoutes