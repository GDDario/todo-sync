import {useEffect, useMemo, useState} from "react";
import {geTodosByTodoList} from "../../services/todo/todoService.ts";
import Todo from "../../models/Todo.ts";
import {TodoGroupResponse, TodoResponse} from "../../services/todo/types.ts";
import TodoComponent from "../Todo/Todo.tsx"
import TodoGroupComponent from "../TodoGroup/TodoGroup.tsx"
import TodoGroup from "../../models/TodoGroup.ts";
import {DndContext, DragEndEvent, DragOverlay, DragStartEvent} from "@dnd-kit/core";
import {arrayMove, SortableContext} from "@dnd-kit/sortable";
import {createPortal} from "react-dom";

const TodoList = ({uuid}) => {
    const [items, setItems] = useState<any[]>([]);
    const itemsIds = useMemo(() => items.map((item) => item.uuid), [items]);
    const [activeItem, setActiveItem] = useState<any | null>(null);

    useEffect((): void => {
        fetchItems();
    }, [uuid]);

    const fetchItems = async () => {
        await geTodosByTodoList(uuid).then((response) => {
            const jsonResponse = response.data.data;

            const ungroupedTodos = jsonResponse.ungrouped_todos.map((todo: TodoResponse) => Todo.fromResponse(todo));
            const todoGroups = jsonResponse.groups.map((group: TodoGroupResponse) => TodoGroup.fromResponse(group));

            setItems([...todoGroups, ...ungroupedTodos]);
            // setItems([...ungroupedTodos]);
            // setItems(todoGroups);
        });
    };

    const onDragStart = (event: DragStartEvent) => {
        console.log(event)
        if (event.active.data.current?.type === "Group") {
            setActiveItem(event.active.data.current.group);
            return;
        }
    };

    const onDragEnd = (event: DragEndEvent) => {
        const { active, over } = event;

        if (!over) {
            return;
        }

        const activeItemId = active.id;
        const overItemId = over.id;

        if (activeItemId === overItemId) {
            return;
        }

        setItems((items) => {
            const activeItemIndex = items.findIndex(item => item.uuid == activeItemId);
            const overItemIndex = items.findIndex(item => item.uuid == overItemId);

            console.log('activeItemIndex', activeItemIndex)
            console.log('overItemIndex', overItemIndex)

            return arrayMove(items, activeItemIndex, overItemIndex);
        })
    }

    return (
        <DndContext
            onDragStart={onDragStart}
            onDragEnd={onDragEnd}
        >
            <div className="flex flex-col gap-2">
                <SortableContext items={itemsIds}>
                    {items &&
                        items.map((item: any) => {
                            if (item instanceof Todo) {
                                return <TodoComponent key={item.uuid} todoListUuid={uuid} todo={item}/>;
                            }

                            return <TodoGroupComponent key={item.uuid} todoListUuid={uuid} group={item}/>;
                        })

                    }
                </SortableContext>
            </div>

            {createPortal(
                <DragOverlay>
                    {
                        activeItem instanceof Todo &&
                        <TodoComponent todoListUuid={uuid} todo={activeItem}/>
                    }
                    {
                        activeItem instanceof TodoGroup &&
                        <TodoGroupComponent todoListUuid={uuid} group={activeItem}/>
                    }
                </DragOverlay>, document.body
            )}
        </DndContext>
    );
};

export default TodoList;