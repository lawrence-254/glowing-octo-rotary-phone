import React from "react";
import {Toast, ToastContainer} from "react-bootstrap";

function Toaster(props){
    const {showToast, title, message, onClose, type} =props;

    return(
        <ToastContainer  position="top-center">
            <Toast onClick={onClose} show={showToast} delay={1500} autohide bg={type}>
                
            </Toast>
        </ToastContainer>
    )
}