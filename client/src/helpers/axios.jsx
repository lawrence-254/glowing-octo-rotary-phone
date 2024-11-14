import axios from "axios";
import CreateAuthRefreshingInterceptor from "axios-auth-refresh";

const axiosService = axios.create({
    baseURL: "http://localhost:8000",
    headers:{
        "content-type": "application/json",
    },
})

axiosService.interceptors.request.use(async (config)=>{
    const {access}=JSON.parse(localStorage.getItem("auth"));
    config.headers.Authorization = `Bearer ${access}`;
    return config;
})
axiosService.interceptors.response.use(
    (res) => Promise.resolve(res),
    (err) => Promise.reject(err)
)

const refreshAuthLogic = async(failedRequest) => {
    const {refresh} = JSON.parse(localStorage.getItem("auth"));
    return axios.post("/refresh/token/", null, {
        baseURL: "http://localhost:8000",
        headers:{
            Authorization: `Bearer ${refresh}`,
        },
    })
}