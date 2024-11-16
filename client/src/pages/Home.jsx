import styled from "styled-components"
import {getUser} from "../hooks/user.actions"
import React from 'react'
import Layout from "../components/navigation/Layout"
import {Row, Col, Image} from "react-bootstrap"
import useSWR from "swr"
import {fetcher} from "../helpers/axios"
import CreatePost from "../components/post/CreatePost"

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
  if (!user){
    return<>Loading...</>
  }
  return (
    <Layout>
    <HomeContainerMain>
        <HomeTitle>
            {user.username}
        </HomeTitle>
        <CreatePost/>
    </HomeContainerMain>
    </Layout>
  )
}

export default Home

