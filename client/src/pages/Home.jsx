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
    return <div
    style={{
      // background:'black',
      color: 'red',
      width: '100vw',
      height: '100vh',
      justifyContent: 'center',
      alignItems: 'center',
      display: 'flex',
      flexDirection: 'column',
      fontSize:'69px',
      background: 'radial-gradient(circle, black 40%, red 100%)'
    }}
    >LOADING...</div>
  }

  return (
    <Layout>
      <Container>
        <div className="home-container-main">
          
          <Row >
            <Col
            xs={12} md={8} lg={6}
            >
              <CreatePost refresh={mutate} info={<>
                {user&&(<h1 className="home-title">
            {user.username}
          </h1>)}
                </>} />
            </Col>
            
          </Row>
          <div className="container-post">

          <Row className='post-section'>
            {data?.results?.map((p, i) => (
                <Post post={p} refresh={mutate} />
            ))}
          
          </Row>
          <Col sm={3} className='suggested-follow-secction'
        //  className="border rounded py-4 h-50"
         >
            <h4>Suggestions</h4>
            <div className="d-flex flex-column">
              {profiles.data && (profiles.data.results.map((profile, index)=>(
                (profile.username !== user.username) &&
                  <ProfileCard key={index} user={profile}/>
                
              )))}
            </div>
            </Col>
          </div>
        </div>
      </Container>
    </Layout>
  )
}

export default Home
