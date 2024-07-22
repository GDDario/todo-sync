import axiosInstance from "../../config/axiosConfig";
import {
    CreateTodoListResponse,
    CreateTodoListValues,
    GetTodoListResponse,
    GetTodoListsResponse,
} from "./types";

const createTodoList = async (values: CreateTodoListValues) => {
    const jsonData = {
        name: values.name,
        is_collaborative: values.isCollaborative,
        collaborators_uuids: values.collaboratorsUuids
    };

    return await axiosInstance.post<CreateTodoListResponse>('todo-list', jsonData);
}

const getTodoLists = async () => {
    return await axiosInstance.get<GetTodoListsResponse>('todo-list');
}

const getTodoList = async (uuid: string) => {
    const url: string = `todo-list/${uuid}`;

    return await axiosInstance.get<GetTodoListResponse>(url);
}

const changePositions = async (uuid: string, positions: string[]) => {
    const url: string = `todo-list/${uuid}/positions`;

    const body = {positions};
    console.log('Sending body', positions)

    return await axiosInstance.put<null>(url, body);
}

export {createTodoList, getTodoLists, getTodoList, changePositions};