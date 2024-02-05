import { MdLogout } from "react-icons/md";
import { useSelector } from "react-redux";
import { useLocation, useNavigate } from "react-router-dom";
import { selectPage } from "../../store/pageSlice";
import { selectUser } from "../../store/userSlice";
import { logout } from "../../services/authentication/authenticationService";

const TopBar = () => {
    const page = useSelector(selectPage);
    const navigate = useNavigate();

    const handleLogout = async () => {
        await logout();
        navigate('/login');
    }

    return (
        <div className="w-full h-[60px] bg-mainColor p-4 flex justify-between">
            
            <span className="text-appWhite">{page.name}</span>

            <button onClick={() => handleLogout()} className="flex gap-2 text-appWhite">
                <MdLogout size={24} />
                Logout
            </button>
        </div>
    );
};

export default TopBar;