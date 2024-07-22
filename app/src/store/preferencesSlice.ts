import {createSlice} from "@reduxjs/toolkit";
import {User} from "../models/user.ts";
import {fontFactors, languages, themes} from "../config/appConfig.ts";

const initialState = {
    theme: themes[0],
    fontFactor: fontFactors[0],
    language: languages[0]
};

const preferencesSlice = createSlice({
    name: 'preferences',
    initialState,
    reducers: {
        setPreferences: (state, {payload}) => {
            return payload;
        },
        updateTheme: (state, {payload}) => {
            return {theme: payload, fontFactor: state.fontFactor, language: state.language};
        },
    }
});

export const selectPreferences = (state: any) => state.preferences;
export const {setPreferences, updateTheme} = preferencesSlice.actions;

export default preferencesSlice.reducer;