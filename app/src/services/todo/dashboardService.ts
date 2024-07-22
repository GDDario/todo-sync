import axiosInstance from "../../config/axiosConfig";
import {GetDashboardResponse} from "./types";

const getDashboardData = async () => {
    return await axiosInstance.get<GetDashboardResponse>('dashboard',);
}

export { getDashboardData };