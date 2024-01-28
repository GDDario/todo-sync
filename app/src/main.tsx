import React from "react";
import ReactDOM from "react-dom/client";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import "./index.css";
import UnauthenticatedRoutes from "./pages/unauthenticated/UnauthenticatedRoutes";
import Login from "./pages/unauthenticated/Login";
import Register from "./pages/unauthenticated/Register";

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
]);

ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>
);
