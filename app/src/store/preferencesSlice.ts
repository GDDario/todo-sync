import {createSlice} from "@reduxjs/toolkit";
import {User} from "../models/user.ts";

const initialState = {
};

const preferencesSlice = createSlice({
    name: 'preferences',
    initialState,
    reducers: {
        setPreferences: (state, {payload}) => {
            return payload;
        },
    }
});

export const selectPreferences = (state: any) => state.preferences;
export const {setPreferences} = preferencesSlice.actions;

export default preferencesSlice.reducer;