import axios from "axios";
import {useNavigate} from "react-router-dom";

function useUserActions(){
    const navigate = useNavigate();
    const baseURL = "http://localhost:8000/api";

    return{
        login,
        register,
        logout,
    };

    function login(data){
        return axios.post(`${baseURL}/auth/login/`, data).then((res)=>{
            setUserData(res);
            navigate('/');

        });
    };

    function register(data){
        return axios.post(`${baseURL}/auth/register/`, data).then((res)=>{
            setUserData(res);
            navigate('/');
        });
    };

    function logout(){
        localStorage.removeItem("auth");
        navigate('/');
    };


};

//fetch user
function getUser(){
    const auth = JSON.parse(localStorage.getItem("auth"));
    if (auth){
        return auth.user;
    }
    return false
};

function getAccessToken(){
    const auth = JSON.parse(localStorage.getItme("auth"));
    return auth.access;
};

function getRefreshToken(){
    const auth = JSON.parse(localStorage.getItem("auth"));
    return auth.refresh;
};

//setting access token and user property

function setUserData(res){
    localStorage.setItem("auth", JSON.stringify({
        user: res.data.user,
        access: res.data.access,
        refresh: res.data.refresh,
    })
);
}

export {useUserActions, getUser, getAccessToken, getRefreshToken }