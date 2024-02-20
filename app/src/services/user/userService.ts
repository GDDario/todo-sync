import axiosInstance from "../../config/axiosConfig";
import { FindUserByEmailResponse } from "./types";

const searchUserByEmail = async (value: string) => {
    return await axiosInstance.get<FindUserByEmailResponse>(`user/email?value=${value}`);
}

export { searchUserByEmail };