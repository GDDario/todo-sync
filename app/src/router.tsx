import {RouteObject, createBrowserRouter} from "react-router-dom";
import UnauthenticatedRoutes from "./pages/unauthenticated/UnauthenticatedRoutes";
import LoginPage from "./pages/unauthenticated/LoginPage/LoginPage.tsx";
import RegisterPage from "./pages/unauthenticated/RegisterPage/RegisterPage.tsx";
import AuthenticatedRoutes from "./pages/authenticated/AuthenticatedRoutes";
import DashboardPage from "./pages/authenticated/DashboardPage/DashboardPage.tsx";
import TodoListPage from "./pages/authenticated/TodoListPage/TodoListPage.tsx";
import ResetEmail from "./pages/account-operations/ResetEmail/ResetEmail.tsx";


const router = createBrowserRouter([
    {
        element: <UnauthenticatedRoutes/>,
        path: "/",
        children: [
            {
                index: true,
                path: "/login",
                element: <LoginPage/>,
            },
            {
                path: "/register",
                element: <RegisterPage/>,
            },
        ],
    },
    {
        element: <AuthenticatedRoutes/>,
        path: "/",
        children: [
            {
                index: true,
                path: "/dashboard",
                element: <DashboardPage/>,
            },
            {
                path: "/todo-list/:uuid",
                element: <TodoListPage/>,
            },
        ],
    },
    {
        element: <ResetEmail/>,
        path: '/reset-email',
    }
]);

export default router;