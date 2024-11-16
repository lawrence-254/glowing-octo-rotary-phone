import React from 'react';
import {Route, Routes} from "react-router-dom";
import ProtectedRoutes from "./routes/ProtectedRoutes";
import Home from "./pages/Home";
import Registration from './pages/authentication/Registration';
import Login from './pages/authentication/Login';

const App = () => {
  return (
    <div>
      <Routes>
        {/* protected routes and requires authentication */}
        <Route path='/' element={
          // <ProtectedRoutes>
            <Home/>
          ///* </ProtectedRoutes> */}
          }/>
          {/* end of protected routes */}
          <Route path="/login/" element={<Login/>}/>
          <Route path="/register/" element={<Registration/>}/>
      </Routes>
    </div>
  )
}

export default App
