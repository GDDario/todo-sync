import Button from "../../../../Button/Button.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {IoSend} from "react-icons/io5";
import Select from "./Select.tsx";

const schema = z.object({
    username: z.string().min(4, "Invalid username."),
    email: z.string().email('Invalid email.'),
});

type updateUserSchema = z.infer<typeof schema>;

const AppSettings = () => {
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
                    <Select name="theme" label="Theme" options={['a']}/>

                    <label htmlFor="countries" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        an option</label>
                    <select id="countries"
                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>

                    <select className="text-black">
                        <option>aa</option>
                        <option>bb</option>
                        <option>cc</option>
                    </select>
                </div>

                <div>
                    <Button value="Submit changes" type="submit" variant="white"
                            icon={<IoSend className="ml-2 text-mainColor"/>}/>
                </div>
            </form>
        </div>
    );
}

export default AppSettings;