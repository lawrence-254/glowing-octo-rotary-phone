import React from "react";
import "../../css/post/Toast.css";

function Toaster(props) {
  const { showToast, title, message, onClose, type } = props;

  return (
    showToast && (
      <div className={`toast-container ${type}`}>
        <div className="toast">
          <div className="toast-header">
            <strong className="toast-title">{title}</strong>
            <button className="toast-close" onClick={onClose}>
              &times;
            </button>
          </div>
          <div className="toast-body">
            <p>{message}</p>
          </div>
        </div>
      </div>
    )
  );
}

export default Toaster;
