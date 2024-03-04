import {Navigate, Outlet, useLocation, useNavigate} from "react-router-dom";
import {getToken, logout, tokenLogin} from "../../services/authentication/authenticationService";
import {useDispatch, useSelector} from "react-redux";
import {selectUser, setUser} from "../../store/userSlice";
import MainLayout from "../../components/MainLayout";
import {useEffect} from "react";
import {getTodoLists} from "../../services/todo/todoListService";
import {setTodoLists} from "../../store/todoListsSlice";
import {showMessage} from "../../store/messageSlice.ts";

const AuthenticatedRoutes = () => {
    const token = getToken();
    const user = useSelector(selectUser);
    const location = useLocation();
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const doLogin = async () => {
        try {
            const userData = await tokenLogin();
            dispatch(setUser(userData.data.data));
            
            const todoListData = await getTodoLists();
            dispatch(setTodoLists(todoListData.data.data));
        } catch (error: any) {
            dispatch(showMessage({ message: 'Error on auto login.', type: 'error' }));
            console.log(error);
            logout();
            navigate('/login');
        }
    }

    if (!token) {
        return <Navigate to="/login" />;
    } else if (location.pathname == "/") {
        return <Navigate to="/dashboard" />;
    }

    useEffect(() => {
        if (!user.id) {
            doLogin();
        }
    }, []);

    return (
        <MainLayout>
            <div className="p-12">
                <Outlet />
            </div>
        </MainLayout>
    );
};

export default AuthenticatedRoutes;
