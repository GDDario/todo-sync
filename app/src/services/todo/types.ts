type TodoResponse = {
    uuid: string;
    title: string;
    due_date?: string;
    is_urgent: boolean;
    tags: Tag[];
    is_completed: boolean;
    description?: string;
    schedule_options?: string;
    created_at?: string;
    updated_at?: string;
    todo_group_uuid?: string;
}

type TodoGroupResponse = {
    uuid: string;
    name: string;
    created_at: string;
    todos?: TodoResponse[]
}

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

type GetTodoListsResponse = {
    data: TodoList[]
};

type GetTodoListResponse = {
    data: TodoList;
};

type DashboardTodos = {
    total: number;
    completed: number;
    pending: number;
    urgent: number;
    timed_out: number;
};

type DashboardCommitment = {
    due_date: Date;
    count: number;
};

type DashboardTag = {
    name: string;
    usage_count: number
};

type DashboardType = {
    todos: DashboardTodos,
    commitments: DashboardCommitment[];
    most_used_tags: DashboardTag[];
}

type GetDashboardResponse = {
    data: DashboardType
};

type GetTodosResponse = {
  data: {
      groups: TodoGroupResponse[]
      ungrouped_todos: TodoResponse[],
      positions: any
  }
};

type CreateTodoGroupValues = {
    name: string;
    todoListUuid: string;
};

type CreateTodoGroupResponse = {
    data: {
        uuid: string;
        name: string;
        created_at: Date;
        updated_at: Date;
    }
};

type ToggleTodoResponse = {
    data: {
        is_completed: boolean;
    }
};

type GetTodoResponse = {
    data: TodoResponse;
};

type CreateTodoData = {
    title: string;
    is_urgent: boolean;
    todo_list_uuid: string;
    todo_group_uuid?: string;
    due_date?: string;
    schedule_options?: string;
};

type UpdateTodoData = {
    title: string;
    is_urgent: boolean;
    todo_list_uuid: string;
    todo_group_uuid?: string;
    due_date?: string;
    schedule_options?: string;
};

export type {
    TodoResponse,
    TodoGroupResponse,
    CreateTodoListValues,
    CreateTodoListResponse,
    GetTodoListsResponse,
    GetDashboardResponse,
    DashboardTodos,
    DashboardCommitment,
    DashboardTag,
    DashboardType,
    GetTodosResponse,
    CreateTodoGroupValues,
    CreateTodoGroupResponse,
    GetTodoListResponse,
    ToggleTodoResponse,
    GetTodoResponse,
    CreateTodoData,
    UpdateTodoData
};