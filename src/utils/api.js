import { unauthorizedRedirect } from "./unauthorizedRedirect.js";

function getApiUrl() {
  const apiUrl = window.location.origin + "/api";
  return apiUrl;
}

const apiUrl = getApiUrl();

export const api = axios.create({
  baseURL: apiUrl,
});

api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("session");
    if (token) {
      config.headers["Authorization"] = token;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

api.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && error.response.status === 401) {
        unauthorizedRedirect()
    }
    return Promise.reject(error);
  }
);
