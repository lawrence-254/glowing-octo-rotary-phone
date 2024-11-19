import styled from "styled-components"
import {getUser} from "../hooks/user.actions"
import React from 'react'
import Layout from "../components/navigation/Layout"
import {Row, Col, Image} from "react-bootstrap"
import {fetcher} from "../helpers/axios"
import CreatePost from "../components/post/CreatePost"
import Post from "../components/post.Post"

const HomeContainerMain = styled.div`
align-items: center;
justify-items:center;
align-contents:center;
justify-content: center;
podding-top: 2rem;
`
const HomeTitle = styled.h1`
color: pink;
display: flex;
alignSelf: center
padding:1em;
`

const Home = () => {
  const user= getUser()  
  const posts = useSWR("/post/", fetcher, {refreshInterval: 1000});

  if (!user){
    return<>Loading...</>
  }

  return (
    <Layout>
    <HomeContainerMain>
        <HomeTitle>
            {user.username}
        </HomeTitle>
        <Row>
          <Col>
          <CreatePost/>
          </Col>
        </Row>
        <Row>
          {posts.data?.results.map((p, i)=>(
            <Post key={i} post={p} refresh={posts.mutate}/>
          ))}
        </Row>
    </HomeContainerMain>
    </Layout>
  )
}

export default Home

