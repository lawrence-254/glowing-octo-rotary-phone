import React,{useState} from 'react';
import {format}from'timeago.js';
import { LikeFilled, CommentOutlined, LikeOutlined, MoreOutlined} from"@ant-design/icons";
import {Image, Card, Dropdown, Button, Modal, Form} from "react-bootstrap";
import {Link} from "react-router-dom";
import axiosService from "../../helpers/axios";
import Toaster from "./Toast"
import { getUser } from '../../hooks/user.actions';
import UpdatePost from './UpdatePost';

import "../../css/components/post/Post.css";

const MoreToggleIcon = React.forwardRef(({ onClick }, ref) => (
    <Link
        to="#"
        ref={ref}
        onClick={(e) => {
            e.preventDefault();
            onClick(e);
        }}
    >
        <MoreOutlined />
    </Link>
));

function Post(props){
    const {post,refresh, isSinglePost} = props;
    const [action, setAction]=useState();
    const [showToast, setShowToast] = useState(false);
    const user = getUser();
    const handleDelete = ()=>{
        axiosService.delete(`/post/${post.id}/`).then(()=>{
            setShowToast(true);
            refresh();
        }).catch((err)=>console.error(err))
    }
    const handleLikeClick = ()=>{
        axiosService.post(`/post/${post.id}/${action}/`).then(()=>{
            refresh();
        }).catch((err)=>console.log(err))
    };

    return(
        <>
        <Card className='card post-card'>
            <Card.Body className="body">
                <h3 className="title">
                    <div className='image-container'>
                        <Image
                        src=""
                        roundedCircle
                        width={48}
                        height={48}
                        className='image'
                        />
                        <div className='details'>
                            <p className='info'>{post.author.username}</p>
                            <p className='info btm'>
                                <small>{format(post.created_at)}</small>
                            </p>
                        </div>
                    </div>
                    {user.username === post.author.username && (
                        <div className="dropper">
                            <Dropdown>
                                <Dropdown.Toggle as={MoreToggleIcon}></Dropdown.Toggle>
                                <Dropdown.Menu>
                                    <Dropdown.Item>
                                        <UpdatePost post={post} refresh={refresh}/>
                                    </Dropdown.Item>
                                    <Dropdown.Item
                                    onClick={handleDelete}
                                    className="dropdown-item">Delete</Dropdown.Item>
                                </Dropdown.Menu>
                            </Dropdown>
                        </div>
                    )}
                </h3>
                {post.title && (<h2>{post.title}</h2>)}
                <p className="post-body">
                    {post.body}
                </p>
                <div className="post-reaction">
                    <LikeFilled className='like-icon'/>
                    <p className='post-reaction-info'>
                        <small>likes: {post.likes_count}</small>
                    </p>
                </div>
            </Card.Body>
            <Card.Footer className="footer">
                <div className="post-miscleneous">
                    <LikeOutlined className='footer-like-outlined-icon' onClick={()=>{
                        if (post.liked){
                            handleLikeClick("remove_like");
                        }else{
                            handleLikeClick("like")
                        }
                    }}/>
                    <p>
                        <small>like</small>
                    </p>
                </div>
                <div className="comment-box-trigger">
                    <CommentOutlined className='comment-icon'/>
                    <p>
                        <small>comment</small>
                    </p>
                </div>
            </Card.Footer>
        </Card>
        <Toaster
        title="Post!"
        message="post deleted"
        type="danger"
        showToast={showToast}
        onClose={()=>setShowToast(false)}
        />
        {isSinglePost && (
            <p className='ms-1 fs-6'>
                <small>
                    <link to={`/post/${post.id}/`}>
                    {post.comments_count} comments
                    </link>
                </small>
            </p>
        )}
        {isSinglePost && (
            <div className="comment-box-trigger">
            <CommentOutlined className='comment-icon'/>
            <p>
                <small>comment</small>
            </p>
        </div>
        )}
        </>
    )
}

export default Post