interface TodoList {
    uuid: string;
    name: string;
    is_collaborative: boolean;
    created_at: string;
    collaborators?: User[];
    updated_at?: string;
}