import {useEffect, useState} from "react";
import ModalButtons from "../ModalButtons/ModalButtons.tsx";
import ModalBase from "../ModalBase/ModalBase.tsx";
import FormField from "../../Form/FormField/FormField.tsx";
import {z} from "zod";
import {useForm} from "react-hook-form";
import {zodResolver} from "@hookform/resolvers/zod";
import TagsSelect from "./TagsSelect.tsx";
import {
    createTodo as apiCreateTodo,
    getTodoByUuid,
    updateTodo as apiUpdateTodo
} from "../../../services/todo/todoService.ts";
import {FaCheck} from "react-icons/fa6";
import {useDispatch} from "react-redux";
import {showMessage} from "../../../store/messageSlice.ts";
import {getInputDateTimeLocalFromUTCDate} from "../../../utils/dateUtil.ts";

type props = {
    todoListUuid: string;
    onClose: () => void;
    uuid?: string;
    groupUuid?: string;
};

const schema = z.object({
    title: z.string(),
    dueDate: z.string().nullable(),
    description: z.string().nullable(),
    scheduleOptions: z.string().nullable(),
});

type todoSchema = z.infer<typeof schema>;

const TodoModal = ({uuid, todoListUuid, groupUuid, onClose}: props) => {
    const [loading, setLoading] = useState(false);
    const dispatch = useDispatch();
    const [tags, setTags] = useState<Tag[]>([]);
    const [isUrgent, setIsUrgent] = useState<boolean>(false);
    const {
        register,
        handleSubmit,
        setValue,
        formState: {errors},
    } = useForm<todoSchema>({resolver: zodResolver(schema)});

    useEffect(() => {
        if (uuid !== undefined) {
            fetchTodo();
        }
    }, [uuid]);

    useEffect(() => {
        console.log('Renderizando TodoModal')
    }, []);

    const fetchTodo = async () => {
        const response = await getTodoByUuid(uuid!);
        const todo = response.data.data;
        setTags(todo.tags);
        setValue('title', todo.title);
        console.log('Todo due date', todo.due_date)
        if (todo.due_date) {
            setValue('dueDate', getInputDateTimeLocalFromUTCDate(todo.due_date));
        }
        setIsUrgent(todo.is_urgent);
        if (todo.description) {
            setValue('description', todo.description);
        }
        if (todo.schedule_options) {
            setValue('scheduleOptions', todo.schedule_options);
        }
    };

    const onSubmit = ({title, dueDate, description, scheduleOptions}) => {
        setLoading(true);
        const tagsUuids = tags.map((tag: Tag) => tag.uuid);

        const data = {
            title,
            is_urgent: isUrgent,
            todo_list_uuid: todoListUuid,
            todo_group_uuid: groupUuid,
            due_date: dueDate,
            tags: tagsUuids,
            description,
            schedule_options: scheduleOptions
        };

        if (uuid) {
            updateTodo(data);
        } else {
            createTodo(data);
        }
    };

    const createTodo = async (data) => {
        await apiCreateTodo(data).then(() => {
            onClose();
            dispatch(showMessage({message: "Todo updated successfully!", type: "success"}));
        }).catch(() => {
            dispatch(showMessage({message: "Error updating the todo.", type: "error"}));
        }).finally(() => {
            setLoading(false);
        });
    }

    const updateTodo = (data) => {
        try {
            apiUpdateTodo(uuid!, data);
            onClose();
            dispatch(showMessage({message: "Todo created successfully!", type: "success"}));
        } catch (e) {
            dispatch(showMessage({message: "Error creating the todo.", type: "error"}));
        } finally {
            setLoading(false);
        }
    }

    return (
        <ModalBase title={`${!uuid ? 'Create' : 'Edit'} Todo`} onClose={() => onClose()}>
            <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-3">
                <FormField
                    type="text"
                    label="Title"
                    name="title"
                    register={register}
                    error={errors.title}
                    variant="bordered"
                />

                <FormField
                    type="datetime-local"
                    label="Due date"
                    name="dueDate"
                    register={register}
                    error={errors.dueDate}
                    variant="bordered"
                />

                <TagsSelect todoTags={tags} callback={(tag: Tag) => {
                    if (!tags.some((iTag: Tag) => iTag.uuid === tag.uuid)) {
                        setTags((prevTags) => [...prevTags, tag]);
                    } else {
                        const newTags = tags.filter((iTag: Tag) => iTag.uuid !== tag.uuid);
                        setTags(newTags);
                    }
                }}
                />

                <div className="flex flex-col">
                    <label htmlFor="todo-textarea">Description</label>
                    <textarea id="todo-textarea" {...register('description')}
                              className="p-1 border border-black rounded-[4px]"/>
                </div>

                <div className="flex gap-2 select-none">
                    <label
                        htmlFor={"checkbox_"}
                        className={`flex justify-center items-center cursor-pointer border-mainColor
                            w-[20px] h-[20px] rounded-[4px] border-[1px] ${isUrgent ? 'bg-mainColor' : 'bg-appWhite'} 
                            ${isUrgent ? 'hover:bg-opacity-70' : 'hover:bg-black hover:bg-opacity-5'}`}
                    >
                        <FaCheck size={14} className="text-appWhite"/>
                    </label>
                    Is urgent
                    <input id={"checkbox_"} type="checkbox" checked={isUrgent} onChange={() => setIsUrgent(!isUrgent)}
                           className="hidden"/>
                </div>

                <FormField
                    type="text"
                    label="Schedule options"
                    name="scheduleOptions"
                    register={register}
                    error={errors.scheduleOptions}
                    variant="bordered"
                />

                <ModalButtons loading={loading} onClose={() => onClose()}/>
            </form>
        </ModalBase>
    );
};

export default TodoModal;