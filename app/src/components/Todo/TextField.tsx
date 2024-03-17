import {useState} from "react";
import {IoCloseCircle} from "react-icons/io5";
import {IoIosCheckmarkCircle} from "react-icons/io";
import {updatedTodoTitle} from "../../services/todo/todoService.ts";
import {useDispatch} from "react-redux";
import {showMessage} from "../../store/messageSlice.ts";

type props = {
    uuid: string;
    title: string;
    loadingCallback: (value: boolean) => void;
};

const TextField = ({title, uuid, loadingCallback}: props) => {
    const [changed, setChanged] = useState(false);
    const [firstState, setFirstState] = useState(title);
    const [value, setValue] = useState(title);
    const dispatch = useDispatch();

    const handleOnChange = (e: any) => {
        setChanged(true);
        setValue(e.target.value)
    }

    const handleCancel = (e: any) => {
        setValue(firstState);
        closeInput(e);
    }

    const handleSave = async (e: any) => {
        loadingCallback(true);
        closeInput(e);

        try {
            await updatedTodoTitle(uuid, value);
            setFirstState(value);
        } catch (e: any) {
            dispatch(showMessage({message: 'Error, try again later.', type: 'error'}))
        } finally {
            loadingCallback(false);
        }

    }

    const closeInput = (e: any) => {
        setChanged(false);
        e.currentTarget.blur();
    }

    return (
        <div className="w-full flex justify-center items-center">
            <div className="w-[650px]">
                <input className="px-1 w-full bg-transparent" value={value} onChange={handleOnChange} onKeyDown={(e: any) => {
                    if (e.key == 'Escape') {
                        handleCancel(e);
                    } else if (e.key == 'Enter') {
                        handleSave(e);
                    }
                }}/>
            </div>
            <div className="pl-2 w-[50px]">
                {changed &&
                    <div className="flex items-center">
                        <button onClick={handleSave}>
                            <IoIosCheckmarkCircle size={22} className="text-mainColor"/>
                        </button>
                        <button onClick={handleCancel}>
                            <IoCloseCircle size={22} className="text-appRed"/>
                        </button>
                    </div>
                }
            </div>
        </div>
    );
};

export default TextField;