import {HiUserCircle} from "react-icons/hi2";
import {useSelector} from "react-redux";
import {selectUser} from "../../store/userSlice";
import {IoSettingsSharp} from "react-icons/io5";
import MenuNavigation from "./MenuNavigation/MenuNavigation.tsx";
import {useEffect, useState} from "react";
import SettingsModal from "../Modal/SettingsModal/SettingsModal.tsx";

const apiPath = import.meta.env.VITE_API_BASE_PATH;

const SideMenu = () => {
    const user = useSelector(selectUser);
    const [modalOpen, setModalOpen] = useState(true);

    return (
        <aside className="h-screen min-w-[320px] bg-mainColor p-2 text-appWhite shadow-sm shadow-black">
            <div className="flex flex-col justify-between h-full">
                <div className="h-[90%]">
                    <div className="flex justify-center items-center flex-col">
                        {
                            user.picture_path ? <div className="w-[180px] h-[180px] rounded-full bg-cover"
                                                     style={{background: `url(${apiPath}${user.picture_path}) center`}}/> :
                                <HiUserCircle size={180}/>
                        }

                        <p className="text-lg mt-4">{user.username}</p>
                        <hr className="mb-8 mt-4 w-full"/>
                    </div>

                    <MenuNavigation/>
                </div>

                <div>
                    <button
                        className={`flex w-full items-center gap-2 text-appWhite p-2 rounded-[4px] hover:bg-appWhite hover:text-mainColor`}
                        onClick={() => setModalOpen(true)}
                    >
                        <span>
                            <IoSettingsSharp size={18}/>
                        </span>
                        <p className="text-nowrap">Settings</p>
                    </button>
                </div>
            </div>

            {
                modalOpen && <SettingsModal onClose={() => setModalOpen(false)}/>
            }
        </aside>
    );
};


export default SideMenu;