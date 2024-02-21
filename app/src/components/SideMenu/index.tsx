import { HiUserCircle } from "react-icons/hi2";
import { useSelector } from "react-redux";
import { selectUser } from "../../store/userSlice";
import { IoSettingsSharp } from "react-icons/io5";
import MenuNavigation from "./MenuNavigation";

const SideMenu = () => {
    const user = useSelector(selectUser);

    return (
        <aside className="h-screen max-w-[320px] w-[20%] bg-mainColor p-2 text-appWhite shadow-sm shadow-black">
            <div className="flex flex-col justify-between h-full">
                <div className="h-[90%]">
                    <div className="flex justify-center items-center flex-col">
                        <HiUserCircle size={180} />
                        <p className="text-lg">{user.username}</p>
                        <hr className="my-8 w-full" />
                    </div>

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
            </div>
        </aside>
    );
};



export default SideMenu;