import React from 'react'
import {useParams} from 'react-router-dom'
import Layout from '../components/navigation/Layout'
import ProfileDetails from '../components/profile/ProfileDetails'
import {Row, Col} from 'react-bootstrap'
import useSWR from 'swr'
import { fetcher } from '../helpers/axios'
import  Post  from '../components/post/Post'


function Profile() {
    const {profileId} = useParams()
    const user = useSWR(`/user/${profileId}`, fetcher)
    const posts = useSWR(`/post/?author__public_id=${profileId}`, fetcher, {refreshInterval: 20000})
  return (
    <Layout hasNavigationBack>
        <Row className="justify-content-evenly">
            <Col sm={9}>
            <ProfileDetails user={user.data}/>
            <div className="">
                <Row className="my-4">
                    {posts.data?.results.map((post, index)=>(
                        <Post key={index} post={post} refresh={post.mutate}/>
                    ))}
                </Row>
            </div>
            </Col>
        </Row>
    </Layout>
  )
}

export default Profile