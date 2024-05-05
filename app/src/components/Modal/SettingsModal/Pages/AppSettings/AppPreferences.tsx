import Button from "../../../../Button/Button.tsx";
import {useForm} from "react-hook-form";
import {z} from "zod";
import {zodResolver} from "@hookform/resolvers/zod";
import {IoSend} from "react-icons/io5";
import Select from "./Select.tsx";
import {useEffect, useState} from "react";
import {useDispatch, useSelector} from "react-redux";
import {selectPreferences, setPreferences} from "../../../../../store/preferencesSlice.ts";
import {updatePreferences} from "../../../../../services/preferences/preferencesService.ts";
import {showMessage} from "../../../../../store/messageSlice.ts";
import {GetUserPreferencesResponse} from "../../../../../services/preferences/types.ts";

type Props = {
    themes: Theme[],
    languages: Language[],
    fontFactors: FontFactor[],
};

const schema = z.object({
    theme: z.string(),
    fontFactor: z.string(),
    language: z.string(),
});

type appPreferencesSchema = z.infer<typeof schema>;

const AppPreferences = (props: Props) => {
    const [themes, setThemes] = useState<any[]>([]);
    const [languages, setLanguages] = useState<any[]>([]);
    const [fontFactors, setFontFactors] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);
    const dispatch = useDispatch();
    const {
        register,
        handleSubmit,
        setValue,
        formState: {errors},
    } = useForm<appPreferencesSchema>({resolver: zodResolver(schema)});
    const appPreferences = useSelector(selectPreferences);

    useEffect(() => {
        setThemes(props.themes.map((theme: Theme) => {
            const isSelected = appPreferences.theme.uuid === theme.uuid;

            return {uuid: theme.uuid, text: theme.name, theme, isSelected};
        }));

        setLanguages(props.languages.map((language: Language) => {
            const text = `${language.name} (${language.tag})`;
            const isSelected = appPreferences.language.uuid === language.uuid;

            return {uuid: language.uuid, text, isSelected};
        }));

        setFontFactors(props.fontFactors.map((fontFactor: FontFactor) => {
            const text = `${fontFactor.value}%`;
            const isSelected = appPreferences.font_factor.uuid === fontFactor.uuid;

            return {uuid: fontFactor.uuid, text, isSelected};
        }));

        setLoading(false);
    }, []);

    const onSubmit = ({theme, language, fontFactor}) => {
        const data = {
            theme_uuid: theme,
            language_uuid: language,
            font_factor_uuid: fontFactor
        };

        updatePreferences(data).then((response: any) => {
            dispatch(showMessage({message: 'Preferences updated successfully!', type: 'success'}))

            dispatch(setPreferences(response.data.data));
        }).catch((_) => {
            dispatch(showMessage({message: 'We could not updated your preferences ):', type: 'error'}))
        });
    }

    return (
        <div className="h-[100%]">
            {!loading &&
                <form
                    className="flex flex-col gap-8 text-appWhite justify-between h-[94.5%]"
                    onSubmit={handleSubmit(onSubmit)}
                >
                    <div className="flex flex-col gap-8">
                        <Select name="theme" label="Theme" options={themes} register={register}/>
                        <Select name="fontFactor" label="Font factor" options={fontFactors} register={register}/>
                        <Select name="language" label="Languages" options={languages} register={register}/>
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