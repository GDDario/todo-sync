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

export type {
    CreateTodoListValues,
    CreateTodoListResponse,
    GetTodoListResponse,
    GetDashboardResponse,
    DashboardTodos,
    DashboardCommitment,
    DashboardTag,
    DashboardType
};