import { Navigate, Outlet, useLocation, useNavigate } from "react-router-dom";
import { getToken, logout, tokenLogin } from "../../services/authentication/authenticationService";
import { useSelector } from "react-redux";
import { selectUser } from "../../store/userSlice";
import MainLayout from "../../components/MainLayout";

const AuthenticatedRoutes = () => {
    const token = getToken();
    const user = useSelector(selectUser);
    const navigate = useNavigate();
    const location = useLocation();

    const doLogin = async (token: string) => {
        try {
            const userData = await tokenLogin({ token });
            // @ts-ignore
            dispatch(loginUser(userData.data.data.user));
        } catch (error: any) {
            logout();
            navigate('/login');
        }
    }

    if (!token) {
        return <Navigate to="/login" />;
    } else if (!user) {
        doLogin(token);
    } else if (location.pathname == "/") {
        return <Navigate to="/dashboard" />;
    }

    return (
        <MainLayout>
            <Outlet />
        </MainLayout>
    );
};

export default AuthenticatedRoutes;
