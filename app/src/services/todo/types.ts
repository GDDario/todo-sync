type TodoResponse = {
    uuid: string;
    title: string;
    due_date: Date;
    is_urgent: boolean;
    tags: Tag[];
    is_completed: boolean;
    description?: string;
    schedule_options?: string;
    created_at?: Date;
    updated_at?: Date;
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
      ungrouped_todos: TodoResponse[]
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
    GetTodoListResponse
};