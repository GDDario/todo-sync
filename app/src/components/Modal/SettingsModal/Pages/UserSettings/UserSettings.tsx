import {HiUserCircle} from "react-icons/hi2";
import Button from "../../../../Button/Button.tsx";
import TextField from "../../../../Todo/TextField.tsx";
import FormField from "../../../../Form/FormField/FormField.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {FaKey} from "react-icons/fa";
import {IoSend} from "react-icons/io5";

const schema = z.object({
    username: z.string().min(4, "Invalid username."),
    email: z.string().email('Invalid email.'),
});

type updateUserSchema = z.infer<typeof schema>;

const UserSettings = () => {
    const {
        register,
        handleSubmit,
        formState: {errors},
    } = useForm<updateUserSchema>({resolver: zodResolver(schema)});

    const onSubmit = ({email, username}) => {
        alert('Submitted successfully!');
    }

    return (
        <div className="h-[100%]">
            <form
                className="flex flex-col gap-8 text-appWhite justify-between h-[94.5%]"
                onSubmit={handleSubmit(onSubmit)}
            >
                <div className="flex flex-col gap-8">
                    <div className="flex gap-6 items-end">
                        { /* TODO: should be the user picture */}
                        <HiUserCircle size={180}/>
                        <div className="mb-4">
                            <Button value="Change picture" variant="white"/>
                        </div>
                    </div>

                    <div className="flex flex-col gap-2">
                        <FormField type="text" label="Username" name="username" register={register}
                                   error={errors.username}/>
                        <FormField type="email" label="Email" name="email" register={register} error={errors.email}/>
                    </div>

                    <div>
                        <Button value="Change password" variant="white" type="button"
                                icon={<FaKey className="ml-2 text-mainColor"/>}/>
                    </div>
                </div>

                <div>
                    <Button value="Submit changes" type="submit" variant="white"
                            icon={<IoSend className="ml-2 text-mainColor"/>}/>
                </div>
            </form>
        </div>
    );
}

export default UserSettings;