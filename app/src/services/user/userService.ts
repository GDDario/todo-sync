import axiosInstance from "../../config/axiosConfig";
import {FindUserByEmailResponse} from "./types";

const searchUserByEmail = async (value: string) => {
    return await axiosInstance.get<FindUserByEmailResponse>(`user/email?value=${value}`);
}

const updateUsernameAndProfilePicture = async (data: any) => {
    return await axiosInstance.post<FindUserByEmailResponse>('user', data, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
}

export {searchUserByEmail, updateUsernameAndProfilePicture};