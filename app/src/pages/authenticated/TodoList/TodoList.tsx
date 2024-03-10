import {Link, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useDispatch} from "react-redux";
import {changePageName} from "../../../store/pageSlice";
import CreateGroupButton from "../../../components/CreateGroupButton/CreateGroupButton.tsx";
import CreateTodoGroupModal from "../../../components/Modal/CreateTodoGroupModal/CreateTodoGroupModal.tsx";

const TodosMock: Todo[] = [];

const TodoList = () => {
    const [isLoading, setLoading] = useState<boolean>(false);
    const [modal, setModal] = useState<boolean>(false);
    const dispatch = useDispatch();
    const {uuid} = useParams();

    useEffect(() => {
        dispatch(changePageName('Todo list'));
        console.log('Request Uuid', uuid);
    }, []);

    return (
        <div>
            <CreateGroupButton onClick={() => setModal(true)}/>

            <p>Hello, welcome to TodoList screen.</p>
            <Link to='/dashboard'>To Dashboard</Link>

            {
                (modal && uuid) && (
                    <CreateTodoGroupModal
                        todoListUuid={uuid}
                        onClose={() => setModal(false)}
                        onSuccess={(todoGroup: TodoGroup) => {
                            console.log("The todogroup " + todoGroup.name + " has ben transferred to TodoList page.");
                        }}
                    />
                )
            }
        </div>
    );
};

export default TodoList;
