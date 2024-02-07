import { useLocation, useNavigate } from "react-router-dom";
import { MdDashboard } from "react-icons/md";
import { FaThList } from "react-icons/fa";
import { FaPlus } from "react-icons/fa";
import { GoDotFill } from "react-icons/go";
import "./style.css";

const MenuNavigation = () => {
    const navigate = useNavigate();
    const location = useLocation();

    return (
        <ul className="flex flex-col gap-3">
            <li className="w-full">
                <button
                    className={`flex w-full items-center gap-2 text-appWhite p-2 rounded-[4px] ${location.pathname == '/dashboard' && 'selected'}`}
                    onClick={() => navigate('/dashboard')}
                >
                    <MdDashboard size={24} />
                    Dashboard
                </button>
            </li>

            {/* TODO: Refactor into component */}
            <li className="w-full">
                <div>
                    <div className="flex items-center justify-between pl-2">
                        <div
                            className={`flex items-center gap-2`}
                        >
                            <FaThList size={20} />
                            Lists
                        </div>
                        <button className="rounded-[4px] p-1 hover-button"><FaPlus size={16} /></button>
                    </div>

                    <ul className="mt-2 flex flex-col gap-1">
                        <li className="pl-8 flex items-center gap-1">
                            <button className={`flex w-full items-center gap-2 text-appWhite p-1 rounded-[4px] ${location.pathname == '/list/label' && 'selected'}`}>
                                <span>
                                    <GoDotFill size={12} />
                                </span>
                                <p className="text-nowrap">Label</p>
                            </button>
                        </li>
                        <li className="pl-8 flex items-center gap-1">
                            <button className={`flex w-full items-center gap-2 text-appWhite p-1 rounded-[4px] ${location.pathname == '/list/label-2' && 'selected'}`}>
                                <span>
                                    <GoDotFill size={12} />
                                </span>
                                <p className="text-nowrap">Label 2</p>
                            </button>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    );
};

export default MenuNavigation;