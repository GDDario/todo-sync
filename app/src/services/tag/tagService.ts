import axiosInstance from "../../config/axiosConfig.ts";
import {GetAllTagsResponse} from "./types.ts";

const getAllTags = async () => {
    return await axiosInstance.get<GetAllTagsResponse>(`tag`);
}

export { getAllTags };