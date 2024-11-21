import React from 'react'
import { getUser } from "../hooks/user.actions"
import Layout from "../components/navigation/Layout"
import { Row, Col, Container } from "react-bootstrap"
import useSWR from 'swr'
import { fetcher } from "../helpers/axios"
import CreatePost from "../components/post/CreatePost"
import Post from "../components/post/Post"
import "../css/pages/Home.css"

const Home = () => {
  const user = getUser()  
  const { data, error, mutate } = useSWR("/post/", fetcher, { refreshInterval: 1000 });

  if (!user) {
    return <>Loading...</>
  }

  return (
    <Layout>
      <Container>
        <div className="home-container-main">
          <h1 className="home-title">
            {user.username}
          </h1>
          <Row>
            <Col xs={12} md={8} lg={6}>
              <CreatePost refresh={data.post.mutate} />
            </Col>
          </Row>
          <Row>
            {data?.results?.map((p, i) => (
              <Col key={i} xs={12} sm={6} md={4} lg={3}>
                <Post post={p} refresh={mutate} />
              </Col>
            ))}
          </Row>
        </div>
      </Container>
    </Layout>
  )
}

export default Home
