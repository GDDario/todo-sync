import Todo from "./Todo.ts";
import {TodoGroupResponse, TodoResponse} from "../services/todo/types.ts";

export default class TodoGroup {
    constructor(
        public uuid: string,
        public name: string,
        public todos: Todo[]
    ) {
    }

    public static fromResponse(todoGroup: TodoGroupResponse): TodoGroup {
        const todos: Todo[] = todoGroup.todos?.map((todo: TodoResponse) => Todo.fromResponse(todo)) || [];

        return new TodoGroup(
            todoGroup.uuid,
            todoGroup.name,
            todos,
        );
    }
}