import axiosInstance from "../../config/axiosConfig.ts";
import {CreateTodoListValues} from "./types.ts";

export const sendResetEmail = async () => {
    return await axiosInstance.post(`email/send-reset-email`);
}

export const resetEmail = async (data:  CreateTodoListValues) => {
    return await axiosInstance.post(`email/reset-email`, data);
}

export const confirmResetEmailToken = async (token: string) => {
    return await axiosInstance.post(`email/confirm-token`, {token});
}
