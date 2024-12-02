import React from 'react';
import {Route, Routes} from "react-router-dom";
import ProtectedRoutes from "./routes/ProtectedRoutes";
import Home from "./pages/Home";
import Registration from './pages/authentication/Registration';
import Login from './pages/authentication/Login';
import SinglePost from './pages/SinglePost';
import Erro from './pages/Erro';
import Profile from './pages/Profile'
import ProfileEdit from './pages/ProfileEdit'

const App = () => {
  return (
    <div>
      <Routes>
        {/* protected routes and requires authentication */}
        <Route path='/' element={
          <ProtectedRoutes>
            <Home/>
         </ProtectedRoutes>
          }/>
          <Route path='/post/:postId/' element={
            <ProtectedRoutes>
              <SinglePost/>
            </ProtectedRoutes>
          }/>
          <Route path='/profile/:profileId/' element={
            <ProtectedRoutes>
              <Profile/>
            </ProtectedRoutes>
          }/>
          <Route path='/profile/:profileId/edit/' element={
            <ProtectedRoutes>
              <ProfileEdit/>
            </ProtectedRoutes>
          }/>
          {/* end of protected routes */}
          <Route path="/login/" element={<Login/>}/>
          <Route path="/register/" element={<Registration/>}/>
          <Route path="*" element={<Erro/>}/>
      </Routes>
    </div>
  )
}

export default App

// NOTE UNCOMMENT THE CODE ABOVE

// import React from 'react';
// import {Route, Routes} from "react-router-dom";
// import Home from "./pages/Home";
// import Registration from './pages/authentication/Registration';
// import Login from './pages/authentication/Login';
// import SinglePost from './pages/SinglePost';

// const App = () => {
//   return (
//     <div>
//       <Routes>
//         {/* protected routes and requires authentication */}
//         <Route path='/' element={<Home/>}/>
//           <Route path='/post/:postId/' element={<SinglePost/>}/>
//           {/* end of protected routes */}
//           <Route path="/login/" element={<Login/>}/>
//           <Route path="/register/" element={<Registration/>}/>
//           <Route path="*" element={<Erro/>}/>
//       </Routes>
//     </div>
//   )
// }

// export default App