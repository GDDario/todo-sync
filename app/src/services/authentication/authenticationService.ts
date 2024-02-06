import { LoginCredentials, LoginResponse, RegisterCredentials, RegisterResponse, TokenLoginCredentials } from "./types";
import axiosInstance from "../../config/axiosConfig";

const register = async (credentials: RegisterCredentials) => {
    return await axiosInstance.post<RegisterResponse>('http://localhost:8000/api/register', credentials);
};

const login = async (credentials: LoginCredentials) => {
    return await axiosInstance.post<LoginResponse>('http://localhost:8000/api/login', credentials);
};

const tokenLogin = async () => {
    return await axiosInstance.get<LoginResponse>('http://localhost:8000/api/authenticated-user');
};

const storeToken = (token: string): void => {
    localStorage.setItem('token', token);
}

const getToken = (): string | null => {
    return localStorage.getItem('token');
};

const logout = async () => {
    await axiosInstance.post('http://localhost:8000/api/logout');
    localStorage.clear();
    sessionStorage.clear();
}

export { register, login, storeToken, getToken, tokenLogin, logout };
