import React,{useState} from 'react';
import {format}from'timeago.js';
import { LikeFilled, CommentOutlined, LikeOutlined} from"@ant-design/icons";
import {Image, Card, Dropdown} from "react-bootstrap";
import axiosService from "../../helpers/axios";
import "../../css/components/post/Post.css";


function Post(props){
    const {post,refresh} = props;
    const handleClick = ()=>{
        axiosService.post(`/post/${post.id}/${action}/`).then(()=>{
            refresh();
        }).catch((err)=>console.log(err))
    };
    return(
        <>
        <Card className='card'>
            <div className="body">
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
                            
                        </div>
                    </div>
                </h3>
            </div>

        </Card>
        </>
    )
}

export default Post