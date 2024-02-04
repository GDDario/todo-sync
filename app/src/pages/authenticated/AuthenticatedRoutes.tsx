import { Navigate, Outlet, useLocation } from "react-router-dom";
import { getToken } from "../../services/authentication/authenticationService";

const AuthenticatedRoutes = () => {
    const token = getToken();
    const location = useLocation();

    if (!token) {
        return <Navigate to="/login" />;
    } else if (location.pathname == "/") {
        return <Navigate to="/dashboard" />;
    }

    return (
        <Outlet />
    );
};

export default AuthenticatedRoutes;
