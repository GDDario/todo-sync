import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {Link, useNavigate} from "react-router-dom";
import FormField from "../../../components/Form/FormField/FormField.tsx";
import Button from "../../../components/Button/Button.tsx";
import {useEffect, useState, useTransition} from "react";
import {useDispatch} from "react-redux";
import {setUser} from "../../../store/userSlice";
import {login, storeToken} from "../../../services/authentication/authenticationService";
import {getTodoLists} from "../../../services/todo/todoListService";
import {setTodoLists} from "../../../store/todoListsSlice";
import {showMessage} from "../../../store/messageSlice.ts";
import {useTranslation} from "react-i18next";

const schema = z.object({
    email: z.string().email('Invalid email.'),
    password: z.string().min(1, "Field required."),
});

type loginSchema = z.infer<typeof schema>;

const LoginPage = () => {
    const {t, i18n} = useTranslation();
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<loginSchema>({ resolver: zodResolver(schema) });

    useEffect(() => {
        const lng = navigator.language;
        i18n.changeLanguage(lng);
    }, []);

    const onSubmit = async ({ email, password }) => {
        setLoading(true);
        try {
            const userData = await login({ email, password });
            
            dispatch(setUser(userData.data.data.user));
            storeToken(userData.data.data.token);

            const todoListData = await getTodoLists();
            dispatch(setTodoLists(todoListData.data.data));

            // TODO: setPreferences
            // dispatch(setPreferences(preferencesData.data.data))

            navigate('/dashboard');
        } catch (error: any) {
            dispatch(showMessage({ message: 'Error, try again.', type: 'error' }));
            console.log('errorrr', error)
        } finally {
            setLoading(false);
        }
    }

    return (
        <div className="max-w-[300px] mx-auto">
            <h1 className="text-center text-2xl">Login</h1>

            <p className="my-4">
                {t('login.doNotHaveAccount')}
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
                    fullWidth
                />
                <div className="mt-2">
                    <FormField
                        type="password"
                        label="Password"
                        name="password"
                        register={register}
                        error={errors.password}
                        fullWidth
                    />
                </div>

                <div className="mt-6 flex justify-center">
                    <Button variant="white" isLoading={isLoading} value="Login" />
                </div>
            </form>
        </div>
    );
};

export default LoginPage;
