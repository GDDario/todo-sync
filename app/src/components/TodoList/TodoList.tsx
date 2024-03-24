import {useEffect, useState} from "react";
import {geTodosByTodoList} from "../../services/todo/todoService.ts";
import Todo from "../../models/Todo.ts";
import {TodoGroupResponse, TodoResponse} from "../../services/todo/types.ts";
import TodoComponent from "../Todo/Todo.tsx"
import TodoGroupComponent from "../TodoGroup/TodoGroup.tsx"
import TodoGroup from "../../models/TodoGroup.ts";

const TodoList = ({uuid}) => {
    const [items, setItems] = useState<[]>([]);

    const fetchItems = async () => {
        await geTodosByTodoList(uuid).then((response) => {
            const jsonResponse = response.data.data;

            const ungroupedTodos = jsonResponse.ungrouped_todos.map((todo: TodoResponse) => Todo.fromResponse(todo));
            const todoGroups = jsonResponse.groups.map((group: TodoGroupResponse) => TodoGroup.fromResponse(group));

            setItems([...todoGroups, ...ungroupedTodos]);
        });
    };

    useEffect((): void => {
        fetchItems();
    }, [uuid]);

    return (
        <div className="flex flex-col gap-2">
            {items &&
                items.map((item: any) => {
                    if (item instanceof Todo) {
                        return <TodoComponent todoListUuid={uuid} key={item.uuid} todo={item} />;
                    }

                    return <TodoGroupComponent key={item.uuid} todoListUuid={uuid} group={item} />;
                })

            }
        </div>
    );
};

export default TodoList;