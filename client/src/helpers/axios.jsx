import axios from "axios";
import createAuthRefreshInterceptor from "axios-auth-refresh";
import { getAccessToken, getRefreshToken } from "../hooks/user.actions";

const axiosService = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "content-type": "application/json",
    },
});

axiosService.interceptors.request.use(async (config) => {
    config.headers.Authorization = `Bearer ${getAccessToken()}`;
    return config;
});

axiosService.interceptors.response.use(
    (res) => Promise.resolve(res),
    (err) => Promise.reject(err)
);

const refreshAuthLogic = async (failedRequest) => {
    return axiosService.post("/refresh/", null, {
        headers: {
            Authorization: `Bearer ${getRefreshToken()}`,
        },
    }).then((resp) => {
        const { access, refresh, user } = resp.data;
        failedRequest.response.config.headers["Authorization"] = "Bearer " + access;
        localStorage.setItem("auth", JSON.stringify({ access, refresh, user }));
        return Promise.resolve();
    }).catch(() => {
        localStorage.removeItem("auth");
        return Promise.reject();
    });
};

createAuthRefreshInterceptor(axiosService, refreshAuthLogic);

export function fetcher(url) {
    return axiosService.get(url).then((res) => res.data);
}

export default axiosService;
