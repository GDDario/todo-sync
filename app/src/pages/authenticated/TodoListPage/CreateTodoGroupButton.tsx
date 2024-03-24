import {FaPlus} from "react-icons/fa";

const CreateTodoGroupButton = ({onClick}) => {
    return (
        <button onClick={() => onClick()}
                className="flex items-center gap-4 text-lg py-1 px-2 rounded-[4px] bg-black bg-opacity-0 hover:bg-opacity-5 transition-all">
            <FaPlus size={20}/>
            Create group
        </button>
    );
};

export default CreateTodoGroupButton;