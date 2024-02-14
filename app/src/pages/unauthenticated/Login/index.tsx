import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link, useNavigate } from "react-router-dom";
import FormField from "../../../components/Form/FormField";
import Button from "../../../components/Button";
import { useState } from "react";
import { useDispatch } from "react-redux";
import { setUser } from "../../../store/userSlice";
import { login, storeToken } from "../../../services/authentication/authenticationService";

const schema = z.object({
    email: z.string().email('Invalid email.'),
    password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const Login = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<loginSchema>({ resolver: zodResolver(schema) });

    const onSubmit = async ({ email, password }) => {
        setLoading(true);
        try {
            const userData = await login({ email, password });
            // @ts-ignore
            console.log(userData.data.data.user);
            dispatch(setUser(userData.data.data.user));
            storeToken(userData.data.data.token);
            navigate('/dashboard');
        } catch (error: any) {
            console.log('errorrr', error)
        } finally {
            setLoading(false);
        }
    }

    return (
        <div className="max-w-[300px] mx-auto">
            <h1 className="text-center text-2xl">Login</h1>

            <p className="my-4">
                Do not have an account?{" "}
                <Link to="/register" className="hover:text-appWhiteDarker">
                    <u>Register now</u>
                </Link>
                .
            </p>

            <form onSubmit={handleSubmit(onSubmit)}>
                <FormField
                    type="email"
                    label="Email"
                    name="email"
                    register={register}
                    error={errors.email}
                />
                <div className="mt-2">
                    <FormField
                        type="password"
                        label="Password"
                        name="password"
                        register={register}
                        error={errors.password}
                    />
                </div>

                <Button isLoading={isLoading} value="Login" />
            </form>
        </div>
    );
};

export default Login;
