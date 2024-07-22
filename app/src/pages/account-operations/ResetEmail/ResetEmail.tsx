import {useLocation, useNavigate, useParams} from "react-router-dom";
import FormField from "../../../components/Form/FormField/FormField.tsx";
import Button from "../../../components/Button/Button.tsx";
import {useForm} from "react-hook-form";
import {zodResolver} from "@hookform/resolvers/zod";
import {showMessage} from "../../../store/messageSlice.ts";
import {useEffect, useState} from "react";
import {z} from "zod";
import {useDispatch} from "react-redux";
import {confirmResetEmailToken, resetEmail} from "../../../services/email/emailService.ts";

const schema = z
    .object({
        email: z.string().email('Invalid email.'),
        emailConfirmation: z.string().email('Invalid email.'),
    })
    .refine((data) => data.email === data.emailConfirmation, {
        message: "Emails don't match",
        path: ["emailConfirmation"],
    });

type resetEmailSchema = z.infer<typeof schema>;

const ResetEmail = () => {
    const [isLoading, setLoading] = useState(true);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const location = useLocation();

    // Extrair o token da URL
    const queryParams = new URLSearchParams(location.search);
    const token = queryParams.get('token');
    const {
        register,
        handleSubmit,
        formState: {errors},
    } = useForm<resetEmailSchema>({resolver: zodResolver(schema)});

    useEffect(() => {
        if (token) {
            confirmResetEmailToken(token).catch((e: any) => {
                console.error(e);
                dispatch(showMessage({message: 'Invalid token!', type: 'error'}));
                navigate('/');
            }).finally(() => {
                setLoading(false);
            });
        }
    }, [token]);

    const onSubmit = async ({email, emailConfirmation}) => {
        setLoading(true);

        resetEmail({
            new_email: email,
            new_email_confirmation: emailConfirmation,
            token: token!
        }).then((_) => {
            dispatch(showMessage({message: 'Email changed succesfully!.', type: 'success'}));
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
                    <h1 className="text-center text-2xl">Reset email</h1>

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
                                type="email"
                                label="Email confirmation"
                                name="emailConfirmation"
                                register={register}
                                error={errors.emailConfirmation}
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

export default ResetEmail;