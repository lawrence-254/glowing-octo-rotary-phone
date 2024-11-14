import React from 'react'
import {Route, Routes} from "react-router-dom"
import ProtectedRoutes from "./routes/ProtectedRoutes"
import Home from "./pages/Home"
import Registration from './pages/Registration'
const App = () => {
  return (
    <div>
      <Routes>
        {/* <Route path="/login/" element={<LoginForm/>}/> */}
        <Route path="/register/" element={<Registration/>}/>
        {/* protected routes and requires authentication */}
        <Route path='/' element={
          <ProtectedRoutes>
            <Home/>
          </ProtectedRoutes>
          }/>
          {/* end of protected routes */}
      </Routes>
    </div>
  )
}

export default App
