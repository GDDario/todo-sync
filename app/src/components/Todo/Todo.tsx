import TodoClass from "../../models/Todo.ts";
import Checkbox from "./Checkbox.tsx";
import {useState} from "react";
import TextField from "./TextField.tsx";
import Chip from "../Chip/Chip.tsx";
import {CiCalendar, CiWarning} from "react-icons/ci";
import {GrFormSchedule} from "react-icons/gr";
import {getDateFromAmericanFormat, isTomorrow} from "../../utils/dateUtil.ts";
import {SlOptionsVertical} from "react-icons/sl";
import TodoModal from "../Modal/TodoModal/TodoModal.tsx";
import TagChip from "../Modal/TodoModal/TagChip.tsx";
import {useSortable} from "@dnd-kit/sortable";
import {CSS} from "@dnd-kit/utilities";
import {MdDragIndicator} from "react-icons/md";

type props = {
    todo: TodoClass;
    todoListUuid: string;
    todoGroupUuid?: string;
};

const Todo = ({todo, todoListUuid, todoGroupUuid}: props) => {
    const [loading, setLoading] = useState(false);
    const [isHovering, setIsHovering] = useState(false);
    const [modalOpened, setModalOpened] = useState(false);

    const {
        setNodeRef,
        attributes,
        listeners,
        transform,
        transition,
        isDragging,
    } = useSortable({
        id: todo.uuid,
        data: {
            type: "Todo",
            todo,
        },
        // disabled: editMode,
    });

    const style = {
        transition,
        transform: CSS.Transform.toString(transform),
    };

    if (isDragging) {
        return (
            <div
                ref={setNodeRef}
                style={style}
                className="
                    opacity-40
                    border-2
                    border-mainColor
                    w-[450px]
                    h-[70px]
                    max-h-[500px]
                    rounded-md
                    flex
                    flex-col
                "
            ></div>
        );
    }

    return (
        <div ref={setNodeRef}>
            <div
                //{...attributes}
                // {...listeners}
                onMouseEnter={() => setIsHovering(true)}
                onMouseLeave={() => setIsHovering(false)}
                className={`relative flex gap-1 p-1 ${loading && 'bg-black bg-opacity-5'} w-full max-w-[800px]`}>
                <div
                    className={`absolute w-full h-full bg-black bg-opacity-5 rounded-[4px] ${!loading && 'hidden'} flex justify-center items-center z-[1000]`}>
                    Loading...
                </div>

                <MdDragIndicator
                    {...attributes}
                    {...listeners}
                    size={22}
                    className={`cursor-grab ${!isHovering ? "opacity-0" : "opacity-100"}`}
                />

                <div className="mt-[2px]">
                    <Checkbox uuid={todo.uuid} isCompleted={todo.is_completed}
                              loadingCallback={(value: boolean) => setLoading(value)}/>
                </div>

                <div className="flex flex-col gap-1">
                    <TextField uuid={todo.uuid} title={todo.title}
                               loadingCallback={(value: boolean) => setLoading(value)}/>

                    <div className="flex items-center gap-2">
                        {
                            todo.is_urgent && <Chip text="Urgent" backgroundColor="#722A2A" icon={<CiWarning/>}/>
                        }
                        {
                            (todo.due_date && isTomorrow(getDateFromAmericanFormat(todo.due_date))) &&
                            <Chip text="Tomorrow" icon={<CiCalendar/>}/>
                        }
                        {
                            todo.schedule_options &&
                            <Chip text="Scheduled" backgroundColor="#808012" icon={<GrFormSchedule/>}/>
                        }

                        {
                            todo.tags.length > 0 && <div className="flex">
                                {(todo.is_urgent || todo.due_date || todo.schedule_options) && <div className="">|</div>}
                                <div className="flex items-center gap-2 ml-2">
                                    {
                                        todo.tags.map((tag: Tag) => <TagChip key={tag.uuid} tag={tag} mini={true}/>)
                                    }
                                </div>
                            </div>
                        }
                    </div>
                </div>

                {
                    isHovering &&
                    <div className="ml-1">
                        <button className="bg-black bg-opacity-0 hover:bg-opacity-5 p-1 rounded-full"
                                onClick={() => setModalOpened(true)}>
                            <SlOptionsVertical/>
                        </button>
                    </div>
                }
            </div>
            {
                modalOpened && <TodoModal todoListUuid={todoListUuid} groupUuid={todoGroupUuid} uuid={todo.uuid}
                                          onClose={() => setModalOpened(false)}/>
            }
        </div>
    );
};

export default Todo;