import React, { useState } from "react";
import axiosService from "../../helpers/axios";
import { getUser } from "../../hooks/user.actions";
import Toaster from "./Toast";
import "../../css/components/post/CreatePost.css";

function CreatePost(props) {
  const {refresh, info} = props
  const [show, setShow] = useState(false);
  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);
  const [form, setForm] = useState({});
  const [validated, setValidated] = useState(false);
  const user = getUser();

  const [showToast, setShowToast] = useState(false);
  const [toastMessage, setToastMessage] = useState("");
  const [toastType, setToastType] = useState(false);

  const handleSubmit = (event) => {
    event.preventDefault();
    const createPostForm= event.currentTarget;
    if (createPostForm.checkValidity()===false){
      event.stopPropagation()
    }
    // if (!form.title || !form.body) {
      setValidated(true);
    //   return;
    // }

    const postData = {
      author: user.id,
      title: form.title,
      body: form.body,
      image: form.image,
    };
    const formData = JSON.stringify(postData)
    axiosService
      .post("/post/", postData)
      .then(() => {
        handleClose();
        setToastMessage("Post made");
        setToastType("success");
        setShowToast(true);
        setForm({});
        refresh();
        console.log("form data to BE", formData)
        console.log("post data imput", postData);
      })
      .catch((err) => {
        if (err.response && err.response.data) {
          console.log("error response data:", err.response.data);
          console.log("form data to BE", formData)
          console.log("post data imput", postData);
      } else {
          console.log("unexpected error:", err.message);
      }
        // console.log(formData)
        setToastMessage("An Error occurred...");
        setToastType("danger");
        setShowToast(true);
      });
  };

  return (
    <div className="main">
      <div className="info-container">{info}</div>
      <div className="form-group form-container">
        <input
          className="post-input"
          type="button"
          value="Share with the world"
          onClick={handleShow}
        />
      </div>
        {show && (
          <div className="modal-overlay">
            <div className="modal">
              <div className="modal-header">
                <h2>Make A Post</h2>
                <button className="close-button" onClick={handleClose}>
                  &times;
                </button>
              </div>
              <form encType="multipart/form-data" className={`modal-body ${validated ? "validated" : ""}`} onSubmit={handleSubmit} mult>
                <div className="form-group">
                  <input
                    name="title"
                    value={form.title || ""}
                    onChange={(e) => setForm({ ...form, title: e.target.value })}
                    type="text"
                    placeholder="Title"
                  />
                </div>
                <div className="form-group">
                  <textarea
                    name="body"
                    value={form.body || ""}
                    onChange={(e) => setForm({ ...form, body: e.target.value })}
                    placeholder="Write something..."
                  ></textarea>
                </div>
                <div className="form-group">
                  <input
                    name="image"
                    onChange={(e) => setForm({ ...form, image: e.target.files[0]})}
                    type="file"
                  />
                </div>
                <button type="submit" className="post-button" disabled={!form.body}>
                  Post
                </button>
              </form>
            </div>
          </div>
        )}
        <Toaster
          title="Post!"
          message={toastMessage}
          showToast={showToast}
          type={toastType}
          onClose={() => setShowToast(false)}
        />
    </div>
  );
}

export default CreatePost;
