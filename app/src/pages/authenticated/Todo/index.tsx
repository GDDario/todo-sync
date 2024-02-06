import { useForm } from "react-hook-form";
import { z } from "zod";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { changePageName } from "../../../store/pageSlice";

const schema = z.object({
    email: z.string().email('Invalid email.'),
    password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const Todo = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(changePageName('Todo'));
    }, []);

    return (
        <div>
            <p>Hello, welcome to Todo screen.</p>
            <Link to='/dashboard'>To Dashboard</Link>
        </div>
    );
};

export default Todo;
