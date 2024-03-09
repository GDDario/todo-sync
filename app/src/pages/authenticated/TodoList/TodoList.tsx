import {Link, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useDispatch} from "react-redux";
import {changePageName} from "../../../store/pageSlice";
import CreateGroupButton from "../../../components/CreateGroupButton/CreateGroupButton.tsx";

const TodosMock: Todo[] = [];

const TodoList = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();
    const {uuid} = useParams();

    useEffect(() => {
        dispatch(changePageName('Todo list'));
        console.log('Request Uuid', uuid);
    }, []);

    return (
        <div>
            <CreateGroupButton onClick={() => {
            }}/>

            <p>Hello, welcome to TodoList screen.</p>
            <Link to='/dashboard'>To Dashboard</Link>
        </div>
    );
};

export default TodoList;
