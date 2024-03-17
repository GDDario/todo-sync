import {TodoResponse} from "../services/todo/types.ts";

export default class Todo {
    constructor(
        public uuid: string,
        public title: string,
        public due_date: string,
        public is_urgent: boolean,
        public tags: Tag[],
        public is_completed: boolean,
        public description?: string,
        public schedule_options?: string,
        public created_at?: string,
        public updated_at?: string,
    ) {
    }

    public static fromResponse(response: TodoResponse): Todo {
        return new Todo(
            response.uuid,
            response.title,
            response.due_date,
            response.is_urgent,
            response.tags,
            response.is_completed,
            response.description,
            response.schedule_options,
            response.created_at,
            response.updated_at
        )
            ;
    }
}