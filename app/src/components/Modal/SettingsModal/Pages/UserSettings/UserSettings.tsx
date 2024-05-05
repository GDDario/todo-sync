import {HiUserCircle} from "react-icons/hi2";
import Button from "../../../../Button/Button.tsx";
import FormField from "../../../../Form/FormField/FormField.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {FaKey} from "react-icons/fa";
import {IoSend} from "react-icons/io5";
import {useDispatch, useSelector} from "react-redux";
import {selectUser, setUser} from "../../../../../store/userSlice.ts";
import {useEffect, useState} from "react";
import {updateUsernameAndProfilePicture} from "../../../../../services/user/userService.ts";
import {showMessage} from "../../../../../store/messageSlice.ts";
import {FaCamera} from "react-icons/fa";
import {MdDelete} from "react-icons/md";

const apiPath = import.meta.env.VITE_API_BASE_PATH;

const MAX_FILE_SIZE = 500000;

const schema = z.object({
    username: z.string().min(4, "Invalid username."),
    profilePicture: z
        .custom<FileList>()
        .transform((list) => list && list[0])
        .superRefine(file => file?.size <= MAX_FILE_SIZE, 'The max file size is 5MB')
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
    const [image, setImage] = useState<string|null>(null);

    useEffect(() => {
        setValue('username', userData.username);
        setImage(apiPath + "/" + userData.picture_path);
    }, [userData]);

    const onSubmit = async (data: any) => {
        const formData = new FormData();

        formData.append("username", data.username);
        formData.append('_method', 'PUT');
        formData.append("profile_picture", data.profilePicture ?? null);

        console.log('The profile picture is', data.profilePicture ?? null)

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
                                ? <div className="w-[180px] h-[180px] rounded-full bg-cover" style={{background: `url(${image}) center`}} />
                                : <HiUserCircle size={180}/>
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
                        {/* TODO: Changing email should send an email to actually change it */}
                        <Button value="Change email" variant="white" type="button"/>

                        {/* TODO: The same here, but with password */}
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