import styled from "styled-components"
import {getUser} from "../hooks/user.actions"
import Navbar from "../components/navbar/Navbar"


import React from 'react'

const HomeContainerMain = styled.div`
align-items: center;
justify-items:center;
align-contents:center;
justify-content: center;
`
const HomeTitle = styled.h1`
color: pink;
display: flex;
alignSelf: center
`

const Home = () => {

  const user= getUser()

  console.log("user", user);
  
  
  return (
    <HomeContainerMain>
      <Navbar />
        <HomeTitle>
            {user.username}
        </HomeTitle>
        Home
    </HomeContainerMain>
  )
}

export default Home

