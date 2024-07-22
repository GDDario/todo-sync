import {HiUserCircle} from "react-icons/hi2";
import Button from "../../../../Button/Button.tsx";
import FormField from "../../../../Form/FormField/FormField.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {FaCamera, FaKey} from "react-icons/fa";
import {IoSend} from "react-icons/io5";
import {useDispatch, useSelector} from "react-redux";
import {selectUser, setUser} from "../../../../../store/userSlice.ts";
import {useEffect, useState} from "react";
import {updateUsernameAndProfilePicture} from "../../../../../services/user/userService.ts";
import {sendResetEmail as sendEmail} from "../../../../../services/email/emailService.ts";
import {showMessage} from "../../../../../store/messageSlice.ts";
import {MdDelete} from "react-icons/md";
import {MdEmail} from "react-icons/md";

const apiPath = import.meta.env.VITE_API_BASE_PATH;
const MAX_FILE_SIZE = 500000;

const schema = z.object({
    username: z.string().min(4, "Invalid username."),
    profilePicture: z
        .custom<FileList>()
        .transform((list) => list && list[0])
        .superRefine(file => file?.size <= MAX_FILE_SIZE)
});

type updateUserSchema = z.infer<typeof schema>;

const UserSettings = () => {
    const dispatch = useDispatch();
    const {
        register,
        handleSubmit,
        setValue,
        formState: {errors},
    } = useForm<updateUserSchema>({resolver: zodResolver(schema)});
    const userData = useSelector(selectUser);
    const [image, setImage] = useState<string | null | undefined>(null);

    useEffect(() => {
        setValue('username', userData.username);
        setImage(userData.picture_path ? `${apiPath}${userData.picture_path}` : undefined);
    }, [userData]);

    const onSubmit = async (data: any) => {

        const formData = new FormData();
        // Needs to be a string because the FormData object only accepts string or blob types.
        const changingPicture: string = data.profilePicture !== undefined ? 'true' : 'false';
        formData.append("username", data.username);
        formData.append('_method', 'PUT');
        formData.append('changing_picture', changingPicture);

        formData.append("profile_picture", data.profilePicture);
        updateUsernameAndProfilePicture(formData).then((userData: any) => {
            dispatch(showMessage({message: 'Data updated successfully!', type: 'success'}))
            dispatch(setUser(userData.data.data))
            console.log('New user image path', userData.data.data.picture_path)
        }).catch((error: any) => {
            console.error(error)
            dispatch(showMessage({message: 'Error: could not update the user data.', type: 'error'}))
        });

    }
    const onError = (error: any) => {
        console.log('Error haha', error)
    }

    const handleImageInput = (event) => {
        if (event.target.files && event.target.files[0]) {
            setImage(URL.createObjectURL(event.target.files[0]));
        }
    }

    const removePicture = () => {
        setImage(null);
        setValue('profilePicture', null);
    }

    const sendResetEmail = () => {
        dispatch(showMessage({message: 'Sending, wait a second...', type: 'info', duration: 10000}));

        sendEmail().then((_) => {
            dispatch(showMessage({message: 'Check your e-mail for further steps.', type: 'success', duration: 3000}));
        }).catch((_) => {
            dispatch(showMessage({message: 'An error ocurred when sending the reset email.', type: 'error', duration: 3000}));
        });

    }

    const sendPasswordChangeEmail = () => {
        dispatch(showMessage({message: 'Check your e-mail for further steps.', type: 'info'}))
    }

    return (
        <div className="h-[100%]">
            <form
                className="flex flex-col gap-8 text-appWhite justify-between h-[94.5%]"
                onSubmit={handleSubmit(onSubmit, onError)}
                encType="multipart/form-data"
            >
                <div className="flex flex-col gap-4">
                    <div className="group w-[180px]">
                        <input id="profilePicture" type="file" {...register('profilePicture')} accept="image/*"
                               onInput={(e) => handleImageInput(e)} className="hidden"/>
                        <div className="relative">
                            {image
                                ? <div className="w-[180px] h-[180px] rounded-full bg-cover"
                                       style={{background: `url(${image}) center`}}/>
                                : <div><HiUserCircle size={180}/></div>
                            }
                            <div
                                className="
                                    absolute
                                    top-0
                                    left-0
                                    w-full h-[180px] bg-opacity-50 bg-black rounded-full
                                    hidden
                                    items-center
                                    justify-center
                                    gap-2
                                    group-hover:flex
                                "
                            >
                                <label htmlFor="profilePicture" className="cursor-pointer">
                                    <FaCamera className="hover:text-red-500" size={30}/>
                                </label>
                                |
                                <button type="button" onClick={removePicture}>
                                    <MdDelete className="hover:text-red-500" size={30}/>
                                </button>
                            </div>
                            {/*<HiUserCircle size={180}/>*/}
                        </div>
                    </div>
                    {errors && <p className="mt-0.5 text-[#ff4e4e]">{errors?.profilePicture?.message as string}</p>}

                    <div className="flex flex-col gap-2">
                        <FormField type="text" label="Username" name="username" register={register}
                                   error={errors.username}/>
                    </div>

                    <hr/>

                    <div className="flex flex-col gap-2 items-start">
                        <Button className="w-[213px]" value="Reset email" variant="white" type="button"
                                icon={<MdEmail size={20} className="ml-2 text-mainColor"/>}
                                onClick={() => sendResetEmail()}/>

                        {/* TODO: The same here, but with password */}
                        <Button className="w-[213px]" value="Change password" variant="white" type="button"
                                icon={<FaKey className="ml-2 text-mainColor"/>}
                                onClick={() => sendPasswordChangeEmail()}/>
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