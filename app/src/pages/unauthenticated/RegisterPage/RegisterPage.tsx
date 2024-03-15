import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Link, useNavigate } from "react-router-dom";
import FormField from "../../../components/Form/FormField/FormField.tsx";
import Button from "../../../components/Button/Button.tsx";
import { register as authRegister } from "../../../services/authentication/authenticationService";
import { useState } from "react";
import {showMessage} from "../../../store/messageSlice.ts";
import {useDispatch} from "react-redux";

const schema = z
    .object({
        username: z
            .string()
            .min(4, "The username must have at least 4 characters."),
        email: z.string().email('Invalid email.'),
        password: z.string().min(6, "Must have at least 6 characters."),
        passwordConfirmation: z.string().min(6, "Must have at least 6 characters."),
    })
    .refine((data) => data.password === data.passwordConfirmation, {
        message: "Passwords don't match",
        path: ["passwordConfirmation"],
    });

type registerSchema = z.infer<typeof schema>;

const RegisterPage = () => {
    const [isLoading, setLoading] = useState(false);
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const {
        register,
        handleSubmit,
        formState: { errors },
        setError
    } = useForm<registerSchema>({ resolver: zodResolver(schema) });

    const onSubmit = async ({ username, email, password, passwordConfirmation }) => {
        setLoading(true);
        try {
            dispatch(showMessage({message: 'Logged in. Welcome.', type: 'error'}));
            await authRegister({ username, email, password, password_confirmation: passwordConfirmation });
            navigate('/login');
        } catch (error: any) {
            dispatch(showMessage({ message: 'Error, try again.', type: 'error' }));
            const errors = error?.response?.data?.errors;
            if (errors) {
                for (const key in errors) {
                    if (Object.prototype.hasOwnProperty.call(errors, key)) {
                        setError(key as keyof registerSchema,
                            {
                                type: 'manual',
                                message: errors[key][0]
                            }
                        );
                    }
                }
            }
        } finally {
            setLoading(false);
        }
    }

    return (
        <div className="max-w-[300px] mx-auto">
            <h1 className="text-center text-2xl">RegisterPage</h1>

            <p className="my-4">
                Already have an account?{" "}
                <Link to="/login" className="hover:text-appWhiteDarker">
                    <u>Log in</u>
                </Link>
                .
            </p>

            <form onSubmit={handleSubmit(onSubmit)}>
                <FormField
                    type="text"
                    label="Username"
                    name="username"
                    register={register}
                    error={errors.username}
                />
                <div className="mt-3">
                    <FormField
                        type="email"
                        label="Email"
                        name="email"
                        register={register}
                        error={errors.email}
                    />
                </div>
                <div className="mt-3">
                    <FormField
                        type="password"
                        label="Password"
                        name="password"
                        register={register}
                        error={errors.password}
                    />
                </div>
                <div className="mt-3">
                    <FormField
                        type="password"
                        label="Confirm password"
                        name="passwordConfirmation"
                        register={register}
                        error={errors.passwordConfirmation}
                    />
                </div>

                <div className="mt-6 flex justify-center">
                    <Button variant="white" value="RegisterPage" isLoading={isLoading} />
                </div>
            </form>
        </div>
    );
};

export default RegisterPage;
