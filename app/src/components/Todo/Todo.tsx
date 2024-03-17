import TodoClass from "../../models/Todo.ts";
import Checkbox from "./Checkbox.tsx";
import {useState} from "react";
import TextField from "./TextField.tsx";

type props = {
    todo: TodoClass,
};

const Todo = ({todo}: props) => {
    const [loading, setLoading] = useState(false);

    return (
        <div className={`relative flex items-center gap-3 p-1 ${loading && 'bg-black bg-opacity-5'} w-full max-w-[700px]`}>
            <div
                className={`absolute w-full h-full bg-black bg-opacity-5 rounded-[4px] ${!loading && 'hidden'} flex justify-center items-center z-[1000]`}>
                Loading...
            </div>
            {/* Top row */}
            <Checkbox uuid={todo.uuid} isCompleted={todo.is_completed}
                      loadingCallback={(value: boolean) => setLoading(value)}/>

            <TextField uuid={todo.uuid} title={todo.title} loadingCallback={(value: boolean) => setLoading(value)} />
            {/* Bottom row */}
        </div>
    );
};

export default Todo;