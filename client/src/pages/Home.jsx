import styled from "styled-components"
import {getUser} from "../hooks/user.actions"
import React from 'react'
import Layout from "../components/navigation/Layout"

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
    <Layout>
    <HomeContainerMain>
        <HomeTitle>
            {user.username}
        </HomeTitle>
        Home
    </HomeContainerMain>
    </Layout>
  )
}

export default Home

