import React, { createContext, useMemo, useState } from "react";
import { useNavigate } from "react-router-dom"; 
import Navigationbar from "./Navbar";
import "../../css/navigation/Layout.css";
import { ArrowLeftOutlined } from "@ant-design/icons";
import Toaster from "../post/Toast"; 

export const Context = createContext("unknown");

function Layout({ children, hasNavigationBack }) {
  const [toaster, setToaster] = useState({
    title: "",
    show: false,
    message: "",
    type: "",
  });

  const navigate = useNavigate();

  const value = useMemo(() => ({ toaster, setToaster }), [toaster]);

  return (
    <Context.Provider value={value}>
      <div>
        <Navigationbar />
        {hasNavigationBack && (
          <ArrowLeftOutlined
            className="alol"
            onClick={() => navigate(-1)}
          />
        )}
        <div className="container">{children}</div>
        <footer>
          all rights reserved footer
        </footer>
      </div>
      <Toaster
        title={toaster.title}
        message={toaster.message}
        type={toaster.type}
        showToast={toaster.show}
        onClick={() => setToaster({ ...toaster, show: false })}
      />
    </Context.Provider>
  );
}

export default Layout;
