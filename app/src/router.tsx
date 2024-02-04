import { createBrowserRouter } from "react-router-dom";
import UnauthenticatedRoutes from "./pages/unauthenticated/UnauthenticatedRoutes";
import Login from "./pages/unauthenticated/Login";
import Register from "./pages/unauthenticated/Register";
import AuthenticatedRoutes from "./pages/authenticated/AuthenticatedRoutes";
import Dashboard from "./pages/authenticated/Dashboard";

const router = createBrowserRouter([
    {
        element: <UnauthenticatedRoutes />,
        path: "/",
        children: [
            {
                index: true,
                path: "/login",
                element: <Login />,
            },
            {
                path: "/register",
                element: <Register />,
            },
        ],
    },
    {
        element: <AuthenticatedRoutes />,
        path: "/",
        children: [
            {
                index: true,
                path: "/dashboard",
                element: <Dashboard />,
            },
        ],
    },
]);

export default router;