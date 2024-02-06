import { useNavigate } from "react-router-dom";
import { HiUserCircle } from "react-icons/hi2";
import { useSelector } from "react-redux";
import { selectUser } from "../../store/userSlice";

const SideMenu = () => {
    const navigate = useNavigate();
    const user = useSelector(selectUser);

    return (
        <aside className="inline-block h-screen min-w-[220px] w-[10%] max-w-[300px] bg-mainColor">
            <div className="flex flex-col gap-8">
                <HiUserCircle />
                <p>{user.username}</p>
            </div>
            <button onClick={() => navigate('/dashboard')} className="flex gap-2 text-appWhite">
                Dashboard
            </button>
            <button onClick={() => navigate('/todo')} className="flex gap-2 text-appWhite">
                Todo
            </button>
        </aside>
    );
};



export default SideMenu;