import { useLocation, useNavigate } from "react-router-dom";
import { MdDashboard } from "react-icons/md";
import { FaThList } from "react-icons/fa";
import { FaPlus } from "react-icons/fa";
import { GoDotFill } from "react-icons/go";
import { useState } from "react";
import CreateTodoListModal from "../../Modal/CreateTodoListModal";
import { useSelector } from "react-redux";
import { selectTodoLists } from "../../../store/todoListsSlice";
import "./style.css";

const MenuNavigation = () => {
    const navigate = useNavigate();
    const location = useLocation();
    const [modal, setModal] = useState<boolean>(false);
    const todoLists = useSelector(selectTodoLists);

    return (
        <div className="overflow-y-scroll overflow-x-hidden h-[63%]">
            <ul className="flex flex-col gap-3 w-[95%]">
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
                            <button className="rounded-[4px] p-1 hover-button" onClick={() => setModal(true)}><FaPlus size={16} /></button>
                        </div>

                        <ul className="mt-2 flex flex-col gap-1">
                            {todoLists && todoLists.map((todoList) => {
                                return (
                                    <li key={todoList.uuid} className="pl-8 flex items-center gap-1">
                                        <button className={`flex w-full items-center gap-2 text-appWhite p-1 rounded-[4px] ${location.pathname == `/list/${1}` && 'selected'} hover-button`}>
                                            <span>
                                                <GoDotFill size={12} />
                                            </span>
                                            <p className="text-nowrap">{todoList.name}</p>
                                        </button>
                                    </li>
                                );
                            })

                            }
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

                {
                    modal && <CreateTodoListModal onClose={() => setModal(false)} />
                }
            </ul>
        </div>
    );
};

export default MenuNavigation;