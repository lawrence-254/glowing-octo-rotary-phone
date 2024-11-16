import React, {useState} from "react";
import {Button, Form, Modal} from "react-bootstrap";
import axiosService from "../../helpers/axios";
import {getUser} from "../../hooks/user.actions";

function CreatePost(){
    const [show, setShow]= useState(false);
    const handleClose=()=>setShow(false);
    const handleShow=()=>setShow(true);
    return(
        <>
        <Form.Group className="my-3 w-75">
            <Form.Control
            className="py-2 rounded-pill border-primary text-primary"
            type="text"
            placeholder="Share with the world"
            onClick={handleShow}
            />

        </Form.Group>
        </>
    )
}

export default CreatePost;