import {useEffect, useState} from "react";
import {geTodosByTodoList} from "../../services/todo/todoService.ts";
import Todo from "../../models/Todo.ts";
import {TodoResponse} from "../../services/todo/types.ts";
import TodoComponent from "../Todo/Todo.tsx"

const TodoList = ({uuid}) => {
    const [items, setItems] = useState<[]>([]);

    const fetchItems = async () => {
        await geTodosByTodoList(uuid).then((response) => {
            const jsonResponse = response.data.data;

            const ungroupedTodos = jsonResponse.ungrouped_todos.map((todo: TodoResponse) => Todo.fromResponse(todo));

            setItems([...jsonResponse.groups, ...ungroupedTodos]);
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
                        return <TodoComponent key={item.uuid} todo={item} />;
                    }

                    // return <div key={item.uuid}>TodoLiust hehehe</div>;
                })

            }
        </div>
    );
};

export default TodoList;