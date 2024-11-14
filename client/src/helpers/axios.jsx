import axios from "axios";
import createAuthRefreshInterceptor from "axios-auth-refresh";
import {getAccesToken, getRefreshToken} from "../hooks/user.actions"

const axiosService = axios.create({
    baseURL: "http://localhost:8000",
    headers:{
        "content-type": "application/json",
    },
})

axiosService.interceptors.request.use(async (config)=>{
    config.headers.Authorization = `Bearer ${getAccesToken()}`;
    return config;
})
axiosService.interceptors.response.use(
    (res) => Promise.resolve(res),
    (err) => Promise.reject(err)
)

const refreshAuthLogic = async(failedRequest) => {
    return axios.post("/refresh/token/", null, {
        baseURL: "http://localhost:8000",
        headers:{
            Authorization: `Bearer ${getRefreshToken()}`,
        },
    }).then((resp) => {
        const {access,refresh, user} =resp.data;
        failedRequest.response.config.headers["Authorization"] = "Bearer"+access;
        localStorage.setItem("auth", JSON.stringify({access, refresh, user}));
    }).catch(()=>{
        localStorage.removeItem("auth");
    });
}

createAuthRefreshInterceptor(axiosService, refreshAuthLogic);

export function fetcher(url){
    return axiosService.get(url).then((res)=>res.data);
}

export default axiosService;