import React from 'react'
import { getUser } from "../hooks/user.actions"
import Layout from "../components/navigation/Layout"
import { Row, Col, Container } from "react-bootstrap"
import useSWR from 'swr'
import { fetcher } from "../helpers/axios"
import CreatePost from "../components/post/CreatePost"
import Post from "../components/post/Post"
import "../css/pages/Home.css"
import ProfileCard from '../components/profile/ProfileCard'

const Home = () => {
  const user = getUser()  
  const { data, error, mutate } = useSWR("/post/", fetcher, { refreshInterval: 1000 });
  const profiles = useSWR("/user/?limit=5", fetcher);

  if (!user) {
    return <>Loading...</>
  }

  return (
    <Layout>
      <Container>
        <div className="home-container-main">
          {user&&(<h1 className="home-title">
            {user.username}
          </h1>)}
          <Row>
            <Col xs={12} md={8} lg={6}>
              <CreatePost refresh={mutate} />
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
        <Col sm={3} className="border rounded py-4 h-50">
        <h4>Suggestions</h4>
        <div className="d-flex flex-column">
          {profiles.data && (profiles.data.results.map((profile, index)=>(
            (profile.username != user.username) &&
              <ProfileCard key={index} user={profile}/>
            
          )))}
        </div>
        </Col>
      </Container>
    </Layout>
  )
}

export default Home
