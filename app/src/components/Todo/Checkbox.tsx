import {useState} from "react";
import {FaCheck} from "react-icons/fa6";
import {toggleTodoState} from "../../services/todo/todoService.ts";
import {showMessage} from "../../store/messageSlice.ts";
import {useDispatch} from "react-redux";

type props = {
    isCompleted: boolean;
    uuid: string;
    loadingCallback: (value: boolean) => void;
};

const Checkbox = ({isCompleted, uuid, loadingCallback}: props) => {
    const [completed, setCompleted] = useState(isCompleted);
    const dispatch = useDispatch();

    const handleChange = async () => {
        loadingCallback(true);

        await toggleTodoState(uuid).then((response: any) => {
            setCompleted(response.data.data.is_completed);
        }).catch(() => {
            dispatch(showMessage({message: 'Error, try again.', type: 'error'}));
        }).finally(() => loadingCallback(false));
    }

    return (
        <div>
            <label
                htmlFor={"checkbox_" + uuid}
                className={`
                    flex justify-center items-center cursor-pointer border-mainColor
                    w-[20px] h-[20px] rounded-[4px] border-[1px] ${completed ? 'bg-mainColor' : 'bg-appWhite'} 
                    ${completed ? 'hover:bg-opacity-70' : 'hover:bg-black hover:bg-opacity-5'}
                `}
            >
                <FaCheck size={14} className="text-appWhite"/>
            </label>
            <input id={"checkbox_" + uuid} type="checkbox" checked={completed} onChange={handleChange}
                   className="hidden"/>
        </div>
    );
};

export default Checkbox;