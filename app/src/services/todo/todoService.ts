import axiosInstance from "../../config/axiosConfig.ts";
import {GetTodosResponse, ToggleTodoResponse} from "./types.ts";

const geTodosByTodoList = async (todoListUuid: string) => {
    const url: string = `todo/${todoListUuid}`;

    return await axiosInstance.get<GetTodosResponse>(url);
}

const toggleTodoState = async (uuid: string) => {
    const url: string = `todo/toggle/${uuid}`;

    return await axiosInstance.put<ToggleTodoResponse>(url);
}

const updatedTodoTitle = async (uuid: string,  title: string) => {
    const url: string = `todo/title/${uuid}`;
    const body: {title: string} = {
        title: title
    }

    return await axiosInstance.put<ToggleTodoResponse>(url, body);
}

export {geTodosByTodoList, toggleTodoState, updatedTodoTitle};