type CreateTodoListValues = {
    name: string;
    isCollaborative: boolean;
    collaboratorsUuids: string[];
};

type CreateTodoListResponse = {
    data: {
        uuid: string;
        name: string;
        is_collaborative: boolean;
        created_at: string;
    }
};

type GetTodoListResponse = {
    data: TodoList[]
};

export type { CreateTodoListValues, CreateTodoListResponse, GetTodoListResponse };