import React,{useState} from 'react';
import {format}from'timeago.js';
import { LikeFilled, CommentOutlined, LikeOutlined} from"@ant-design/icons";
import {Image, Card, Dropdown, Button, Modal, Form} from "react-bootstrap";
import {Link} from "react-router-dom";
import axiosService from "../../helpers/axios";
import Toast from "./Toast"

import "../../css/components/post/Post.css";

// const MoreToggleIcon = React.foward.Ref(({onClick}, ref)=>(
//     <Link to="#"
//     ref={ref}
//     onClick={(e)=>{
//         e.preventDefault();
//         onClick(e);
//     }}>
//         {/* <MoreOutlined/> */}
//     </Link>
// ))

function Post(props){
    const {post,refresh} = props;
    const [action, setAction]=useState();
    const handleLikeClick = ()=>{
        axiosService.post(`/post/${post.id}/${action}/`).then(()=>{
            refresh();
        }).catch((err)=>console.log(err))
    };

    return(
        <Card className='card'>
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
                            <p className='info'>{post.author.name}</p>
                            <p className='info btm'>
                                <small>{format(post.created_at)}</small>
                            </p>
                        </div>
                    </div>
                </h3>
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
    )
}

export default Post