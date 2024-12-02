import React, {useState, useContext} from 'react';
import {Button, Modal, Form, Dropdown} from "react-bootstrap"
import axiosService from '../../helpers/axios';
import { Context } from '../navigation/Layout';

function UpdateComment(props) {
    const {postId, comment, refresh}=props;
    const [show, setShow]=useState(false);
    const [validated, setValidated] = useState(false)
    const [form, setForm]= useState({
        author: comment.author.id,
        title: comment.title,
        image: comment.image,
        body: comment.body,
        post: postId
    })
    const {toaster, setToaster} = useContext(Context);

    const handleSubmit=(event)=>{
        event.preventDefault();
        const updateCommentForm = event.currentTarget;

        if (updateCommentForm.checkValidity() === false){
            event.stopPropagation();
        }
        setValidated(true);

        const updatedCommentFormData = {
            author: form.author,
            title: form.title,
            image: form.image,
            body: form.body,
            post: postId
        }

        axiosService.put(`/post/${postId}/comment/${comment.id}/`, updatedCommentFormData).then(()=>{
            handleClose();
            setToaster({
                type:"success",
                message:"comment updated succesfull",
                show:true,
                title: "Edit successfull"
            });
            refresh();
        }).catch((error)=>{
            setToaster({
                type: "danger",
                message:"An error occured while trying to edit your comment",
                show: true,
                title: "Edit not successfull"
            })
        })
    }
  return (
    <>
    <Dropdown.Item onClick={handleShow}>Modify</Dropdown.Item>
    <Modal show={show} onHide={handleClose}>
        <Modal.Header closeButton className="border-0">
            <Modal.Title>Edit Comment</Modal.Title>
        </Modal.Header>
        <Modal.Body className="border-0">
            <Form noValidate validated={validated} onSubmit={handleSubmit}>
            <Form.Group className='mb-3'>
                    <Form.Control
                    name="title"
                    value={form.title}
                    onChange={(e)=>setForm({
                        ...Form,
                        title: e.target.value,
                    })}
                    type='text'
                    />
                </Form.Group>
                <Form.Group className='mb-3'>
                    <Form.Control
                    name="body"
                    value={form.body}
                    onChange={(e)=>setForm({
                        ...Form,
                        body: e.target.value,
                    })}
                    as="textrea"
                    rows={4}
                    />
                    <Form.Group className='mb-3'>
                    <Form.Control
                    name="image"
                    value={form.image}
                    onChange={(e)=>setForm({
                        ...Form,
                        image: e.target.value,
                    })}
                    type="file"
                    />
                </Form.Group>
                </Form.Group>
            </Form>
        </Modal.Body>
        <Modal.Footer>
            <Button Variant="primary" onClick={handleSubmit}>
                Edit Comment
            </Button>
        </Modal.Footer>
    </Modal>
    </>
  )
}

export default UpdateComment