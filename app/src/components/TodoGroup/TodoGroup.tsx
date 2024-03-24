import TodoGroupClass from "../../models/TodoGroup.ts";
import TodoComponent from "../Todo/Todo.tsx"
import Button from "../Button/Button.tsx";
import {FaPlus} from "react-icons/fa";
import TodoModal from "../Modal/TodoModal/TodoModal.tsx";
import {useState} from "react";

type props = {
    group: TodoGroupClass,
    todoListUuid: string;
};

const TodoGroup = ({group, todoListUuid}: props) => {
    const [modalOpened, setModalOpened] = useState(false);

    return (
        <div className="mb-4">
            <h3 className="text-lg">{group.name}</h3>
            <div className="ml-8">
                {
                    group.todos && group.todos.map((todo) => {
                        return <TodoComponent todoListUuid={todoListUuid} todoGroupUuid={group.uuid} key={todo.uuid} todo={todo}/>;
                    })
                }
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
                modalOpened && <TodoModal todoListUuid={todoListUuid} groupUuid={group.uuid} onClose={() => setModalOpened(false)}/>
            }
        </div>
    );
};

export default TodoGroup;