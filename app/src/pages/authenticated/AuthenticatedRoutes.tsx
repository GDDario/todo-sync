import { Navigate, Outlet, useLocation, useNavigate } from "react-router-dom";
import { getToken, logout, tokenLogin } from "../../services/authentication/authenticationService";
import { useDispatch, useSelector } from "react-redux";
import { selectUser, setUser } from "../../store/userSlice";
import MainLayout from "../../components/MainLayout";
import { useEffect } from "react";

const AuthenticatedRoutes = () => {
    const token = getToken();
    const user = useSelector(selectUser);
    const navigate = useNavigate();
    const location = useLocation();
    const dispatch = useDispatch();

    const doLogin = async () => {
        try {
            const userData = await tokenLogin();
            // @ts-ignore
            console.log(userData);
            dispatch(setUser(userData.data.data));
        } catch (error: any) {
            console.log(error);
            // logout();
            // navigate('/login');
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
            <Outlet />
        </MainLayout>
    );
};

export default AuthenticatedRoutes;
