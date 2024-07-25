import {useLocation, useNavigate} from "react-router-dom";
import FormField from "../../../components/Form/FormField/FormField.tsx";
import Button from "../../../components/Button/Button.tsx";
import {useForm} from "react-hook-form";
import {zodResolver} from "@hookform/resolvers/zod";
import {showMessage} from "../../../store/messageSlice.ts";
import {useEffect, useState} from "react";
import {z} from "zod";
import {useDispatch} from "react-redux";
import {confirmResetPasswordToken, resetPassword} from "../../../services/password/passwordService.ts";

const schema = z
    .object({
        password: z.string(),
        passwordConfirmation: z.string(),
    })
    .refine((data) => data.password === data.passwordConfirmation, {
        message: "Passwords don't match",
        path: ["passwordConfirmation"],
    });

type resetPasswordSchema = z.infer<typeof schema>;

const ResetPassword = () => {
    const [isLoading, setLoading] = useState(true);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const location = useLocation();

    const queryParams = new URLSearchParams(location.search);
    const token = queryParams.get('token');
    const {
        register,
        handleSubmit,
        formState: {errors},
    } = useForm<resetPasswordSchema>({resolver: zodResolver(schema)});

    useEffect(() => {
        if (token) {
            confirmResetPasswordToken(token).catch((e: any) => {
                console.error(e);
                dispatch(showMessage({message: 'Invalid token!', type: 'error'}));
                navigate('/');
            }).finally(() => {
                setLoading(false);
            });
        }
    }, [token]);

    const onSubmit = async ({password, passwordConfirmation}) => {
        setLoading(true);

        resetPassword({
            new_password: password,
            new_password_confirmation: passwordConfirmation,
            token: token!
        }).then((_) => {
            dispatch(showMessage({message: 'Password reseted succesfully!.', type: 'success'}));
            navigate('/');
        }).catch((e: any) => {
            console.error(e);
            dispatch(showMessage({message: 'Error, try again.', type: 'error'}));
        });
    }

    const cancelOperation = (e: MouseEvent) => {
        e.stopPropagation();
    }

    return (
        <div className="min-h-screen bg-appWhite flex justify-center items-center p-8 relative">
            <div className="p-4 shadow-lg rounded-lg bg-white w-[50%] min-w-[350px] max-w-[550px] ">
                <div
                    className="mx-auto w-[100%] border rounded-lg bg-mainColor p-8 text-appWhite z-10">
                    <h1 className="text-center text-2xl">Reset password</h1>

                    <form onSubmit={handleSubmit(onSubmit)}>
                        <FormField
                            type="password"
                            label="Password"
                            name="password"
                            register={register}
                            error={errors.password}
                            fullWidth
                        />
                        <div className="mt-2">
                            <FormField
                                type="password"
                                label="Password confirmation"
                                name="passwordConfirmation"
                                register={register}
                                error={errors.passwordConfirmation}
                                fullWidth
                            />
                        </div>

                        <div className="mt-6 flex justify-center gap-4">
                            <Button variant="danger" isLoading={isLoading} value="Cancel" onClick={cancelOperation}/>
                            <Button variant="white" isLoading={isLoading} value="Cofirm"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

export default ResetPassword;