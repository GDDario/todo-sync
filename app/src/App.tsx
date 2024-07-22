import {useDispatch, useSelector} from "react-redux";
import router from "./router";
import {RouterProvider} from "react-router-dom";
import Message from "./components/Message/Message.tsx";
import {useEffect} from "react";
import {themes} from "./config/appConfig.ts";
import {selectPreferences, updateTheme} from "./store/preferencesSlice.ts";

const normalizeTheme = (theme: string) => {
    return theme.replace(' ', '-').toLowerCase();
}

const getStoredTheme = (): string | null => {
    const storedTheme = localStorage.getItem('theme');
    return storedTheme && themes.includes(storedTheme) ? storedTheme : null;
}

const App = () => {
    const preferences = useSelector(selectPreferences);
    const dispatch = useDispatch();

    useEffect(() => {
        const storedTheme = getStoredTheme();

        if (!storedTheme) {
            const defaultTheme = themes[0];
            localStorage.setItem('theme', defaultTheme);

            if (preferences.theme !== defaultTheme) {
                dispatch(updateTheme(defaultTheme));
            }
        } else {
            if (preferences.theme !== storedTheme) {
                dispatch(updateTheme(storedTheme));
            }
        }
    }, [preferences.theme, dispatch]);

    useEffect(() => {
        const appRoot = document.getElementById('app-root');

        if (appRoot) {
            appRoot.className.replace('theme-brown', '');
            appRoot.className.replace('theme-cyan-blue', '');
            appRoot.className.replace('theme-leaf-green', '');
            appRoot.classList.add(`theme-${normalizeTheme(preferences.theme)}`);
        }
    }, [preferences.theme]);

    return (
        <>
            <Message/>
            {preferences && (
                <div id="app-root" className={`theme-${normalizeTheme(preferences.theme)}`}>
                    <RouterProvider router={router}/>
                </div>
            )}
        </>
    );
}

export default App;
