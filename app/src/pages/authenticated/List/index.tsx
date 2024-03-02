import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { changePageName } from "../../../store/pageSlice";

const TodoList = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(changePageName('Todo list'));
    }, []);

    return (
        <div>
            <p>Hello, welcome to TodoList screen.</p>
            <Link to='/dashboard'>To Dashboard</Link>
        </div>
    );
};

export default TodoList;
