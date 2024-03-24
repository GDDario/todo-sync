import axiosInstance from "../../config/axiosConfig.ts";
import {CreateTodoData, GetTodoResponse, GetTodosResponse, ToggleTodoResponse, UpdateTodoData} from "./types.ts";

const geTodosByTodoList = async (todoListUuid: string) => {
    const url: string = `todo/todo-list/${todoListUuid}`;

    return await axiosInstance.get<GetTodosResponse>(url);
};

const toggleTodoState = async (uuid: string) => {
    const url: string = `todo/toggle/${uuid}`;

    return await axiosInstance.put<ToggleTodoResponse>(url);
};

const updatedTodoTitle = async (uuid: string, title: string) => {
    const url: string = `todo/title/${uuid}`;
    const body: { title: string } = {
        title: title
    }

    return await axiosInstance.put<ToggleTodoResponse>(url, body);
};

const getTodoByUuid = async (uuid: string) => {
    const url: string = `todo/${uuid}`;

    return await axiosInstance.get<GetTodoResponse>(url);
};

const createTodo = async (data: CreateTodoData) => {
    return await axiosInstance.post<GetTodoResponse>('todo', data);
};

const updateTodo = async (uuid: string, data: UpdateTodoData) => {
    const url: string = `todo/${uuid}`;

    return await axiosInstance.put<GetTodoResponse>(url, data);
};

export {geTodosByTodoList, toggleTodoState, updatedTodoTitle, getTodoByUuid, createTodo, updateTodo};