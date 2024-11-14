import React from "react";
import {Navigate} from "react-router-dom";
import {useUserAcitons} from "../hooks/user.actions"

const ProtectedRoutes = ({children}) => {
    const {user} = useUserAcitons.getUser()
  return user.account ? <>{children}</> : <Navigate to="/login" />
  
}

export default ProtectedRoutes