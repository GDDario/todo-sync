import { HiUserCircle } from "react-icons/hi2";
import { useSelector } from "react-redux";
import { selectUser } from "../../store/userSlice";
import { IoSettingsSharp } from "react-icons/io5";
import MenuNavigation from "./MenuNavigation";

const SideMenu = () => {
    const user = useSelector(selectUser);

    return (
        <aside className="flex flex-col justify-between h-screen min-w-[220px] w-[10%] max-w-[300px] bg-mainColor p-4 text-appWhite shadow-sm shadow-black">
            <div>
                <div className="flex items-center flex-col">
                    <HiUserCircle size={180} />
                    <p className="text-lg">{user.username}</p>
                </div>
                <hr className="my-8" />

                <MenuNavigation />
            </div>

            <div> 
                <button className={`flex w-full items-center gap-2 text-appWhite p-2 rounded-[4px] hover-button`}>
                    <span>
                        <IoSettingsSharp size={18} />
                    </span>
                    <p className="text-nowrap">Settings</p>
                </button>
            </div>
        </aside>
    );
};



export default SideMenu;