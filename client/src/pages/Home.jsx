import styled from "styled-components"
import {getUser} from "../hooks/user.actions"


import React from 'react'

const HomeContainerMain = styled.div`
background: red
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
        <HomeTitle>
            {user.username}
        </HomeTitle>
        Home
    </HomeContainerMain>
  )
}

export default Home

