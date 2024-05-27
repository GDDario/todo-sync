import {Provider, useDispatch, useSelector} from "react-redux";
import store from "./store";
import router from "./router";
import {RouterProvider} from "react-router-dom";
import Message from "./components/Message/Message.tsx";
import {useEffect, useState} from "react";
import {themes} from "./config/appConfig.ts";
import {selectPreferences, updateTheme} from "./store/preferencesSlice.ts";

const normalizeTheme = (theme: string) => {
    return theme.replace(' ', '-').toLowerCase();
}

const getStoredTheme = (): string | null => {
    const storagedTheme = localStorage.getItem('theme');
    return storagedTheme && themes.includes(storagedTheme) ? storagedTheme : null;
}

const App = () => {
    const preferences = useSelector(selectPreferences);
    const dispatch = useDispatch();

    useEffect(() => {
        const storagedTheme = getStoredTheme();

        if (!storagedTheme) {
            const defaultTheme = themes[0];
            localStorage.setItem('theme', defaultTheme);

            if (preferences.theme !== defaultTheme) {
                dispatch(updateTheme(defaultTheme));
            }
        } else {
            if (preferences.theme !== storagedTheme) {
                dispatch(updateTheme(storagedTheme));
            }
        }
    }, [preferences, dispatch]);

    return (
        <>
            <Message />
            {preferences && (
                <div className={`theme-${normalizeTheme(preferences.theme)}`}>
                    <RouterProvider router={router} />
                </div>
            )}
        </>
    );
}

export default App;