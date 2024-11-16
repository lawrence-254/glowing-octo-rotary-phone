import React, {useState} from "react";
import {Button, Form, Modal} from "react-bootstrap";
import axiosService from "../../helpers/axios";
import {getUser} from "../../hooks/user.actions";
import Toaster from "./Toast";

function CreatePost(){
    const [show, setShow]= useState(false);
    const handleClose=()=>setShow(false);
    const handleShow=()=>setShow(true);
    const [form, setForm] = useState({})
    const [validated, setValidated]=useState(false)
    const user = getUser();

    const [showToast, setShowToast]= useState(false);
    const [toastMessage, setToastMessage] = useState("");
    const [toastType, setToastType] = useState(false)

    const handleSubmit = (event)=>{
        event.preventDefault()
        const createPostForm = event.currentTarget;

        if (createPostForm.checkValidity()===false){
            event.stopPropagation();
        }
        setValidated(true);

        const formData = {
            author: user.id,
            title: form.title,
            body: form.body,
            image: form.image
        }
        console.log(formData)

        axiosService.post("/post/", formData).then(()=>{
            handleClose();
            setToastMessage("Post made");
            setToastType("success");
            setForm({});
        }).catch(()=>{
            setToastMessage("An Error occured...");
            setToastType("danger");
        })
    }
    return(
        <>
        <Form.Group className="my-3 w-75">
            <Form.Control
            className="py-2 rounded-pill border-primary text-primary"
            type="text"
            placeholder="Share with the world"
            onClick={handleShow}
            />
            <Modal show={show} onHide={handleClose}>
                <Modal.Header closeButton className="border-0">
                    <Modal.Title>Make A Post</Modal.Title>
                </Modal.Header>
                <Modal.Body className="border-0">
                    <Form noValidate validated={validated} onSubmit={handleSubmit}>
                        <Form.Group className="mb-3">
                            <Form.Control
                            name="title"
                            value={form.title}
                            onChange={(e)=>setForm({...form, title:e.target.value})}
                            type="text"
                            />
                        </Form.Group>
                        <Form.Group className="mb-3">
                            <Form.Control
                            name="body"
                            value={form.body}
                            onChange={(e)=>setForm({...form, body:e.target.value})}
                            as="textarea"
                            />
                        </Form.Group>
                        <Form.Group>
                            <Form.Control
                            name="image"
                            value={form.image}
                            onChange={(e)=>setForm({...form, image: e.target.value})}
                            type="file"
                            />
                        </Form.Group>
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="primary" onClick={handleSubmit} disabled={form.body === undefined}>
                        Post
                    </Button>
                </Modal.Footer>
            </Modal>
            <Toaster
            title="Post!"
            message={toastMessage}
            showToast={showToast}
            type={toastType}
            onClose={()=>setShowToast(false)}
            />
        </Form.Group>
        </>
    )
}

export default CreatePost;