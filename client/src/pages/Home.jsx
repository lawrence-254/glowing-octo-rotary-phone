import React from 'react'
import styled from "styled-components"
import { getUser } from "../hooks/user.actions"
import Layout from "../components/navigation/Layout"
import { Row, Col } from "react-bootstrap"
import useSWR from 'swr'
import { fetcher } from "../helpers/axios"
import CreatePost from "../components/post/CreatePost"
import Post from "../components/post/Post"

const HomeContainerMain = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding-top: 2rem;
`

const HomeTitle = styled.h1`
  color: pink;
  display: flex;
  align-self: center;
  padding: 1em;
`

const Home = () => {
  const user = getUser()  
  const { data, error, mutate } = useSWR("/post/", fetcher, { refreshInterval: 1000 });

  if (!user) {
    return <>Loading...</>
  }

  return (
    <Layout>
      <HomeContainerMain>
        <HomeTitle>
          {user.username}
        </HomeTitle>
        <Row>
          <Col>
            <CreatePost />
          </Col>
        </Row>
        <Row>
          {data?.results?.map((p, i) => (
            <Post key={i} post={p} refresh={mutate} />
          ))}
        </Row>
      </HomeContainerMain>
    </Layout>
  )
}

export default Home
