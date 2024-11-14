import axios from"axios"
import {useNavigate} from "react-router-dom"

function useUserActions(){
    const navigate = useNavigate();
    const baseURL = "http://localhost:8000/api";
    return {
        register,
        login,
        logout
    };
    // register function

    //login function
    function login(data){
        return axios.post(`${baseURL}/auth/login/`, data).then((res)=>{
            setUserData(data);
            navigate('/');
        })
    }
    //logout function
    function logout(){
        localStorage.removeItem("auth");
    }
    // get user
    function getUser(){
        const auth = JSON.parse(localStorage.getItem("auth"));
        return auth.user;
    }
    //get access token
    function getAccessToken(){
        const auth = JSON.parse(localStorage.getItem("auth"));
        return auth.access;
    }
    // get refresh token
    function getRefreshToken(){
        const auth = JSON.parse(localStorage("auth"));
        return auth.refresh;
    }
    //set access token, refresh token, and user property
    function setUserData(data){
        localStorage.setItem("auth", JSON.stringify({
            access: res.data.access,
            refresh:  res.data.refresh,
            user: res.data.user
        }))
    }
}
