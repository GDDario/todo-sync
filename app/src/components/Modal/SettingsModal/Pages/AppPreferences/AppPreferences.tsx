import Button from "../../../../Button/Button.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {IoSend} from "react-icons/io5";
import Select from "./Select.tsx";
import {useEffect, useState} from "react";
import {useDispatch} from "react-redux";
import {setPreferences} from "../../../../../store/preferencesSlice.ts";
import {showMessage} from "../../../../../store/messageSlice.ts";
import {fontFactors, getConfig, languages, themes} from "../../../../../config/appConfig.ts";

const schema = z.object({
    theme: z.string(),
    fontFactor: z.string(),
    language: z.string(),
});

type appPreferencesSchema = z.infer<typeof schema>;

const AppPreferences = () => {
    const [loading, setLoading] = useState(true);
    const dispatch = useDispatch();
    const {
        register,
        handleSubmit,
        setValue,
        getValues,
        formState: {errors},
    } = useForm<appPreferencesSchema>({resolver: zodResolver(schema)});

    useEffect(() => {
        setValue('theme', getConfig('theme'));
        setValue('language', getConfig('language'));
        setValue('fontFactor', getConfig('fontFactor'));

        setLoading(false);
    }, []);

    const onSubmit = ({theme, language, fontFactor}) => {
        localStorage.removeItem('theme');
        localStorage.setItem('theme', theme);
        localStorage.removeItem('language');
        localStorage.setItem('language', language);
        localStorage.removeItem('fontFactor');
        localStorage.setItem('fontFactor', fontFactor);

        dispatch(showMessage({message: 'Configs updated successfully!', type: 'success'}))
        dispatch(setPreferences({
            theme,
            fontFactor,
            language
        }));
    }

    return (
        <div className="h-[100%]">
            {!loading &&
                <form
                    className="flex flex-col gap-8 text-appWhite justify-between h-[94.5%]"
                    onSubmit={handleSubmit(onSubmit)}
                >
                    <div className="flex flex-col gap-4">
                        <Select name="theme" label="Theme" options={themes} register={register}
                                defaultOption={getValues('theme') || themes[0]}/>
                        <Select name="fontFactor" label="Font factor" options={fontFactors} register={register}
                                defaultOption={getValues['fontFactor'] || fontFactors[0]}/>
                        <Select name="language" label="Languages" options={languages} register={register}
                                defaultOption={getValues('language') || languages[0]}/>
                    </div>

                    <div>
                        <Button value="Submit changes" type="submit" variant="white"
                                icon={<IoSend className="ml-2 text-mainColor"/>}/>
                    </div>
                </form>
            }
        </div>
    );
}

export default AppPreferences;