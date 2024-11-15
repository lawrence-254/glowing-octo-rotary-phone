import axios from "axios";
import { useNavigate } from "react-router-dom";

function useUserActions() {
    const navigate = useNavigate();
    const baseURL = "http;//localhost:8000/api";

    return {
        register,
        login,
        logout,
    };

    function setUserData(res) {
        localStorage.setItem("auth", JSON.stringify({
            access: res.data.access,
            refresh: res.data.refresh,
            user: res.data.user
        }));
    }

    function register(data) {
        return axios.post(`${baseURL}/auth/register`, data)
            .then((res) => {
                setUserData(res);
                navigate('/');
            })
            .catch((error) => {
                console.error("Registration error:", error);
                throw error;
            });
    }

  

    function login(data) {
        return axios.post(`${baseURL}/auth/login/`, data)
            .then((res) => {
                setUserData(res);
                navigate('/');
            })
            .catch((error) => {
                console.error("Login error:", error.message);
                throw error;
            });
    }

    function logout() {
        localStorage.removeItem("auth");
        navigate('/login');
    }

}

// Define getUser, getAccessToken, and getRefreshToken outside of useUserActions
function getUser() {
    const auth = JSON.parse(localStorage.getItem("auth"));
    return auth ? auth.user : null;
}

function getAccessToken() {
    const auth = JSON.parse(localStorage.getItem("auth"));
    return auth ? auth.access : null;
}

function getRefreshToken() {
    const auth = JSON.parse(localStorage.getItem("auth"));
    return auth ? auth.refresh : null;
}

// export default useUserActions;
export { useUserActions, getUser, getAccessToken, getRefreshToken };
