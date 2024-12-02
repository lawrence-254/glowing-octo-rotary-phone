import React,{useState, useContext} from 'react';
import { Image, Card, Dropdown } from 'react-bootstrap';
import axiosService from '../../helpers/axios';
import {getUser} from '../../hooks/user.actions';
import { Context } from '../navigation/Layout';
import {format} from 'timeago.js';
import UpdateComment from './UpdateComment';
import { MoreOutlined} from"@ant-design/icons";
import {Link} from "react-router-dom";


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

export const Comment = (props) => {
    const {postId, comment, refresh} = props;
    const {toaster, setToaster} = useContext(Context);
    const user = getUser();

    const handleDelete = ()=>{
        axiosService.delete(`/post/${postId}/comment/${comment.id}`).then(()=>{
            setToaster({
                type:"danger",
                message: "Comment Deleted",
                show: true,
                title:"Comment deleted"
            })
            refresh();
        }).catch((err)=>{
            setToaster({
                type:"warning",
                message:"An error occured while trying to delete the comment",
                show: true,
                title: "Error"
            })
        })
    }
  return (
    <Card className="rounded-3 my-2">
        <Card.Body>
            <Card.Title className="d-flex flex-row justify-content-between">
                <div className="d-flex lex-row">
                    <Image
                    src=""
                    roundedCircle
                    width={48}
                    height={48}
                    className="me-2 border border-primary border-2"
                    />
                    <div className="d-flex flex-column justify-content-start align-self-center mt-2">
                        <p className="fs-6 m-0">{comment.author.username}</p>
                        <p className="fs-6 fw-lighter">
                            <small>{format(comment.created_at)}</small>
                        </p>
                    </div>
                </div>
                {user.username === comment.author.username && (
                    <div>
                        <Dropdown>
                            <Dropdown.Toggle as={MoreToggleIcon}></Dropdown.Toggle>
                            <Dropdown.Menu>
                                <UpdateComment comment={comment} refresh={refresh} postId={postId}/>
                                <Dropdown.Item
                                onClick={handleDelete}
                                className="text-danger"
                                >Delete</Dropdown.Item>
                            </Dropdown.Menu>
                        </Dropdown>
                    </div>
                )}
            </Card.Title>
            {
            comment.image && (<Image src={comment.image}/>)
            }
            <Card.Text>
                <h1>{comment.title}</h1>
                <p>{comment.body}</p>
            </Card.Text>
        </Card.Body>
    </Card>
  )
}
