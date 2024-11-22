import React, {useState} from 'react';
import {Button, Modal, Form, Dropdown} from "react-bootstrap";
import axiosService from '../../helpers/axios';
import Toaster from './Toast';

function UpdatePost(props) {
    const [post, refresh]=props;
    const [show, setShow]= useState(false);

    const handleClose =()=>setShow(false)
    const handleOpen = ()=>setShow(true);
  return (
    <>
      <Dropdown.Item onClick={handleOpen}>Modify</Dropdown.Item>
      <Modal show={show} onHide={handleClose}>
          {/*  */}
      </Modal>
    </>
  )
}

export default UpdatePost