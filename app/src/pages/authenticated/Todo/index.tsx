import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link, useNavigate } from "react-router-dom";
import FormField from "../../../components/FormField";
import WhiteButton from "../../../components/WhiteButton";
import { useState } from "react";
import { useDispatch } from "react-redux";
import { loginUser } from "../../../store/userSlice";
import { login, storeToken } from "../../../services/authentication/authenticationService";

const schema = z.object({
    email: z.string().email('Invalid email.'),
    password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const Todo = () => {
    const [isLoading, setLoading] = useState(false);
    

    return (
        <div>
            <p>Hello, welcome to Todo screen.</p>
            <Link to='/dashboard'>To Dashboard</Link>
        </div>
    );
};

export default Todo;
