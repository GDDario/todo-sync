import {useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useDispatch} from "react-redux";
import {changePageName} from "../../../store/pageSlice";
import {getTodoList} from "../../../services/todo/todoListService.ts";
import {getDateFromUTC} from "../../../utils/dateUtil.ts";
import CreateTodoGroupButton from "./CreateTodoGroupButton.tsx";
import TodoListComponent from "../../../components/TodoList/TodoList.tsx";

const TodoListPage = () => {
    const [loading, setLoading] = useState<boolean>(true);
    const [modal, setModal] = useState<boolean>(false);
    const dispatch = useDispatch();
    const {uuid} = useParams();

    const mountPageName = (todoList: TodoList): string => {
        const createdAt: Date = new Date(todoList.created_at);

        let pageName: string = `${todoList.name} - created at: ${getDateFromUTC(createdAt)}`;

        if (todoList.updated_at != null) {
            const updatedAt: Date = new Date(todoList.updated_at);
            pageName += ` - updated at: ${getDateFromUTC(updatedAt)}`;
        }

        return pageName;
    }

    const fetchTodoList = async () => {
        await getTodoList(uuid as string).then((response) => {
            const metaData = response.data.data;

            dispatch(changePageName(mountPageName(metaData)));
        }).finally(() => {
            setLoading(false);
        });
    };

    useEffect(() => {
        fetchTodoList();
    }, [uuid]);

    return (
        <div>
            <CreateTodoGroupButton onClick={() => setModal(true)}/>

            <div className="mt-4"></div>

            <TodoListComponent uuid={uuid}/>

            {/*{*/}
            {/*    (modal && uuid) && (*/}
            {/*        <CreateTodoGroupModal*/}
            {/*            todoListUuid={uuid}*/}
            {/*            onClose={() => setModal(false)}*/}
            {/*            onSuccess={(todoGroup: TodoGroup) => {*/}
            {/*                console.log("The todogroup " + todoGroup.name + " has ben transferred to TodoListPage page.");*/}
            {/*            }}*/}
            {/*        />*/}
            {/*    )*/}
            {/*}*/}
        </div>
    );
};

export default TodoListPage;
