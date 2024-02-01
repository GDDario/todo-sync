import { Navigate, Outlet, useLocation } from "react-router-dom";

const UnauthenticatedRoutes = () => {
  const auth = { token: false };
  const location = useLocation();

  if (auth.token) {
    return <Navigate to="/dashboard" />;
  } else if (location.pathname == "/") {
    return <Navigate to="/login" />;
  }

  return (
    <div className="min-h-screen bg-slate-100 flex justify-center items-center p-8 relative">
      <div className="p-4 shadow-lg rounded-lg bg-white">
        <div className="mx-auto w-[30%] min-w-[350px] max-w-[400px] border rounded-lg bg-mainColor p-8 text-white z-10">
          <Outlet />
        </div>
      </div>
    </div>
  );
};

export default UnauthenticatedRoutes;