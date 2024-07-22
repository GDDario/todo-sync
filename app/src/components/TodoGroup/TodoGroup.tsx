import TodoGroupClass from "../../models/TodoGroup.ts";
import TodoComponent from "../Todo/Todo.tsx"
import Button from "../Button/Button.tsx";
import {FaPlus} from "react-icons/fa";
import TodoModal from "../Modal/TodoModal/TodoModal.tsx";
import {useMemo, useState} from "react";
import {SortableContext, useSortable} from "@dnd-kit/sortable";
import {CSS} from "@dnd-kit/utilities";
import {MdDragIndicator} from "react-icons/md";

type props = {
    group: TodoGroupClass,
    todoListUuid: string;
};

const TodoGroup = ({group, todoListUuid}: props) => {
    const [modalOpened, setModalOpened] = useState(false);
    const [isHovering, setIsHovering] = useState(false);
    const todosIds = useMemo(() => group.todos.map((todo) => todo.uuid), [group.todos]);

    const {setNodeRef, attributes, listeners, transform, transition, isDragging} = useSortable({
        id: group.uuid,
        data: {
            type: "Group",
            group
        }
    });

    const style = {
        transition,
        transform: CSS.Transform.toString(transform)
    }

    if (isDragging) {
        return (
            <div
                ref={setNodeRef}
                style={style}
                className="
                    w-full
                    h-[100px]
                    border-2
                    border-rose-500
                "
            >

            </div>);
    }

    return (
        <div
            ref={setNodeRef}
            style={style}
            className="mb-4"
            onMouseEnter={() => setIsHovering(true)}
            onMouseLeave={() => setIsHovering(false)}
        >
            <div
            >
                <div className="flex gap-2 items-center">
                    <MdDragIndicator
                        {...attributes}
                        {...listeners}
                        size={22}
                        className={`cursor-grab ${!isHovering ? "opacity-0" : "opacity-100"}`}
                    />
                    <h3 className="text-lg">{group.name}</h3>
                </div>
            </div>
            <div className="ml-8">
                <SortableContext items={todosIds}>
                    {
                        group.todos && group.todos.map((todo) => {
                            return (
                                <TodoComponent
                                    key={todo.uuid}
                                    todoListUuid={todoListUuid}
                                    todoGroupUuid={group.uuid}
                                    todo={todo}
                                />
                            );
                        })
                    }
                </SortableContext>

                <div className="mt-2">
                    <Button
                        value="Add todo"
                        type="button"
                        variant="underline"
                        onClick={() => setModalOpened(true)}
                        icon={<FaPlus className="ml-2" size={18}/>}
                    />
                </div>
            </div>
            {
                modalOpened &&
                <TodoModal todoListUuid={todoListUuid} groupUuid={group.uuid} onClose={() => setModalOpened(false)}/>
            }
        </div>
    );
};

export default TodoGroup;