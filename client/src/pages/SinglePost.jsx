import React from 'react';
import Layout from '../components/navigation/Layout';
import {Row, Col} from 'react-bootstrap';
import {useParams} from 'react-router-dom';
import useSWR from 'swr';
import {fetcher} from '../helpers/axios';
import Post from '../components/post/Post';
import CreateComment from '../components/comments/CreateComment';
import Comment from '../components/comments/Comment';


function SinglePost() {
    let {postId} = useParams();
    const { data, error, mutate } = useSWR(`/post/${postId}/comment/`, fetcher, { refreshInterval: 1000 });

  return (
    <Layout hasNavigationBack>
        {data.results ? (
            <Row className='justify-content-center'>
                <Col sm={8}>
                <Post post={data.results} refresh={mutate} isSinglePost/>
                </Col>
            </Row>
        ):(
        <div>Loading...</div>
        )}
    </Layout>
  )
}

export default SinglePost