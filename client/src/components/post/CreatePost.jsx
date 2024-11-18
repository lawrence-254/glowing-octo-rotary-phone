import React, { useState } from "react";
import axiosService from "../../helpers/axios";
import { getUser } from "../../hooks/user.actions";
import Toaster from "./Toast";
import "../../css/post/CreatePost.css";

function CreatePost() {
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
    if (!form.title || !form.body) {
      setValidated(true);
      return;
    }

    const formData = {
      author: user.id,
      title: form.title,
      body: form.body,
      image: form.image,
    };

    axiosService
      .post("/post/", formData)
      .then(() => {
        handleClose();
        setToastMessage("Post made");
        setToastType("success");
        setShowToast(true);
        setForm({});
      })
      .catch(() => {
        setToastMessage("An Error occurred...");
        setToastType("danger");
        setShowToast(true);
      });
  };

  return (
    <>
      <div className="form-group">
        <input
          className="post-input"
          type="text"
          placeholder="Share with the world"
          onClick={handleShow}
        />
        {show && (
          <div className="modal-overlay">
            <div className="modal">
              <div className="modal-header">
                <h2>Make A Post</h2>
                <button className="close-button" onClick={handleClose}>
                  &times;
                </button>
              </div>
              <form className={`modal-body ${validated ? "validated" : ""}`} onSubmit={handleSubmit}>
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
                    onChange={(e) => setForm({ ...form, image: e.target.value })}
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
    </>
  );
}

export default CreatePost;
