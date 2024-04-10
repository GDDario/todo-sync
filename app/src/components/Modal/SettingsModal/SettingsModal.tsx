import {MouseEvent, useEffect, useMemo, useState} from "react";
import SettingsModalMenu from "./SettingsModalMenu.tsx";
import {MenuItem} from "./types.ts";
import {FaUser} from "react-icons/fa";
import {IoApps} from "react-icons/io5";
import {IoMdClose} from "react-icons/io";
import AppSettings from "./Pages/AppSettings/AppSettings.tsx";
import UserSettings from "./Pages/UserSettings/UserSettings.tsx";

const menuItems: MenuItem[] = [
    {
        "title": "User settings",
        "isSelected": true,
        "icon": <FaUser size={20}/>
    },
    {
        "title": "App settings",
        "isSelected": false,
        "icon": <IoApps size={20}/>
    }
];

type Props = {
    onClose: () => void;
};

const SettingsModal = ({onClose}: Props) => {
    const [items, setItems] = useState<MenuItem[]>(menuItems);
    const selectedItem = useMemo(() => {
        return items.filter((item) => item.isSelected)[0];
    }, items);

    useEffect(() => {
        document.addEventListener('keydown', (event: KeyboardEvent) => {
            if (event.key == 'Escape') {
                onClose();
            }
        });
    }, []);

    const handleSelect = (clickedItem: MenuItem) => {
        setItems(items.map(item => item.title === clickedItem.title ? {...item, isSelected: true} : {
            ...item,
            isSelected: false
        }));
    }

    const handleClose = (event: MouseEvent<HTMLElement>) => {
        if (event.target == event.currentTarget) {
            onClose();
        }
    }

    return (
        <div
            className="absolute top-0 left-0 z-[100] w-screen h-screen overflow-hidden flex justify-center items-center bg-black bg-opacity-55 text-black"
            onClick={(event: MouseEvent<HTMLElement>) => handleClose(event)}>
            <div className="bg-mainColor rounded min-w-[80%] max-w-[1300px] min-h-[70%] flex relative">
                <button className="absolute right-6 top-4 text-appWhite" onClick={() => onClose()}>
                    <IoMdClose size={36}/>
                </button>
                <div className="border-r-2 py-4 px-6 min-w-[300px]">
                    <div className="py-[32px]">
                        <SettingsModalMenu menuItems={items} handleSelect={handleSelect}/>
                    </div>
                </div>
                <div className="py-4 px-6 w-full">
                    <h3 className="text-white text-center text-2xl">Settings</h3>
                    {
                        selectedItem.title === "User settings"
                            ? <UserSettings/>
                            : <AppSettings/>
                    }
                </div>
            </div>
        </div>
    );
};

export default SettingsModal;