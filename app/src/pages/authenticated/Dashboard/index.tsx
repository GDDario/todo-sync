import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link, useNavigate } from "react-router-dom";
import FormField from "../../../components/FormField";
import WhiteButton from "../../../components/WhiteButton";
import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { loginUser } from "../../../store/userSlice";
import { login, storeToken } from "../../../services/authentication/authenticationService";
import { changePageName } from "../../../store/pageSlice";

const schema = z.object({
    email: z.string().email('Invalid email.'),
    password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const Dashboard = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();
    
    useEffect(() => {
        dispatch(changePageName('Dashboard'));
    }, []);

    return (
        <div>
            <p>Hello, welcome to Todo screen.</p>
            <Link to='/todo'>To Todo</Link>
        </div>
    );
};

export default Dashboard;
