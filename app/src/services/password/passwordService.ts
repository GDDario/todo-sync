import axiosInstance from "../../config/axiosConfig.ts";
import {ResetPasswordValues} from "./types.ts";

export const sendResetPasswordEmail = async () => {
    return await axiosInstance.post(`password/send-reset-email`);
}

export const resetPassword = async (data:  ResetPasswordValues) => {
    return await axiosInstance.post(`password/reset`, data);
}

export const confirmResetPasswordToken = async (token: string) => {
    console.log('Sending requisition...');
    return await axiosInstance.post(`password/confirm-token`, {token});
}
