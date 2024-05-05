import {useEffect, useMemo, useState} from "react";
import {geTodosByTodoList} from "../../services/todo/todoService.ts";
import Todo from "../../models/Todo.ts";
import {TodoResponse} from "../../services/todo/types.ts";
import TodoComponent from "../Todo/Todo.tsx"
import {DndContext, DragEndEvent, DragOverlay, DragStartEvent} from "@dnd-kit/core";
import {arrayMove, SortableContext} from "@dnd-kit/sortable";
import {createPortal} from "react-dom";
import {changePositions} from "../../services/todo/todoListService.ts";
import {useDispatch} from "react-redux";
import {showMessage} from "../../store/messageSlice.ts";

const TodoList = ({uuid}) => {
    const dispatch = useDispatch();
    const [todos, setTodos] = useState<Todo[]>([]);
    const [positions, setPositions] = useState<string[]>([]);
    const [activeTodo, setActiveTodo] = useState<any | null>(null);
    const todosUuids = useMemo(() => {
        const filteredAndOrderedUuids = positions.filter(p => todos.some(t => t.uuid === p));

        todos.forEach(todo => {
            if (!filteredAndOrderedUuids.includes(todo.uuid)) {
                filteredAndOrderedUuids.push(todo.uuid);
            }
        });

        return filteredAndOrderedUuids;
    }, [todos, positions]);

    useEffect((): void => {
        fetchItems();
    }, [uuid]);

    const fetchItems = async () => {
        await geTodosByTodoList(uuid).then((response) => {
            const jsonResponse = response.data.data;
            const todos = jsonResponse.todos.map((todoResponse: TodoResponse) => Todo.fromResponse(todoResponse));

            const todosMap = new Map(todos.map(todo => [todo.uuid, todo]));

            const orderedTodos: Todo[] = jsonResponse.positions
                .map(uuid => todosMap.get(uuid))
                .filter(todo => todo !== undefined) as Todo[];

            console.log(todos.map(todo => todo.uuid))

            setTodos(orderedTodos ? orderedTodos: todos);
            setPositions(jsonResponse.positions);
            console.log('Ordered todos', orderedTodos)
            console.log('todos', todos)
        });
    };

    const onDragStart = (event: DragStartEvent) => {
        if (event.active.data.current?.type === "Todo") {
            setActiveTodo(event.active.data.current.todo);
            return;
        }
    };

    const onDragEnd = (event: DragEndEvent) => {
        const {active, over} = event;

        if (!over) {
            return;
        }

        const activeItemId = active.id;
        const overItemId = over.id;

        if (activeItemId === overItemId) {
            return;
        }

        setTodos((todos) => {
            const activeItemIndex = todos.findIndex(item => item.uuid == activeItemId);
            const overItemIndex = todos.findIndex(item => item.uuid == overItemId);

            const newArray = arrayMove(todos, activeItemIndex, overItemIndex);
            updatePositions(newArray.map((todo: Todo) => todo.uuid));

            return newArray;
        })
    }

    const updatePositions = async (newPositions: string[]) => {
        try {
            await changePositions(uuid, newPositions);
            setPositions(newPositions);
        } catch (e: any) {
            dispatch(showMessage({message: "Could not change the positions", type: "error"}))
        }
    }

    return (
        <DndContext
            onDragStart={onDragStart}
            onDragEnd={onDragEnd}
        >
            <div className="flex flex-col gap-2">
                <SortableContext items={todosUuids}>
                    {todos &&
                        todos.map((todo: any) => {
                            return <TodoComponent key={todo.uuid} todoListUuid={uuid} todo={todo}/>;
                        })

                    }
                </SortableContext>
            </div>

            {createPortal(
                <DragOverlay>
                    {
                        activeTodo &&
                        <TodoComponent todoListUuid={uuid} todo={activeTodo}/>
                    }
                </DragOverlay>, document.body
            )}
        </DndContext>
    );
};

export default TodoList;