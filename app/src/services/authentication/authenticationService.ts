import {LoginCredentials, LoginResponse, RegisterCredentials, RegisterResponse} from "./types";
import axiosInstance from "../../config/axiosConfig";

const register = async (credentials: RegisterCredentials) => {
    return await axiosInstance.post<RegisterResponse>('/register', credentials);
};

const login = async (credentials: LoginCredentials) => {
    return await axiosInstance.post<LoginResponse>('/login', credentials);
};

const tokenLogin = async () => {
    return await axiosInstance.get<LoginResponse>('/user/authenticated');
};

const storeToken = (token: string): void => {
    localStorage.setItem('token', token);
}

const getToken = (): string | null => {
    return localStorage.getItem('token');
};

const logout = async (): Promise<void> => {
    return await axiosInstance.post('/logout');
}

export { register, login, storeToken, getToken, tokenLogin, logout };
