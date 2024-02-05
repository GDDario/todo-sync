import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import { setName } from "../../store/pageSlice";

const SideMenu = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();

    const changePage = (path: string, name: string) => {
        dispatch(setName(name));
        navigate(path);
    };

    return (
        <aside className="inline-block h-screen min-w-[220px] w-[10%] max-w-[300px] bg-mainColor">
            <button onClick={() => changePage('/dashboard', 'Dashboard')} className="flex gap-2 text-appWhite">
                Dashboard
            </button>
            <button onClick={() => changePage('/todo', 'Todo')} className="flex gap-2 text-appWhite">
                Todo
            </button>
        </aside>
    );
};



export default SideMenu;