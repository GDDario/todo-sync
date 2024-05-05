import axiosInstance from "../../config/axiosConfig.ts";
import {GetAllPreferencesResponse, GetUserPreferencesResponse, UpdateUserPreferencesBody} from "./types.ts";

const getUserPreferences = async () => {
    return await axiosInstance.get<GetUserPreferencesResponse>('preferences/logged-user');
}

const getAllPreferences = async () => {
    return await axiosInstance.get<GetAllPreferencesResponse>('preferences');
}

const updatePreferences = async (data: UpdateUserPreferencesBody) => {
    return await axiosInstance.put<GetUserPreferencesResponse>('preferences', data);
}

export { getUserPreferences, getAllPreferences, updatePreferences };