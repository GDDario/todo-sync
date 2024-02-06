import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";

type UserType = {
    uuid: string;
    email: string;
    username: string;
}

const initialState: UserType = {
    uuid: '',
    username: '',
    email: ''
};

const userSlice = createSlice({
    name: 'user',
    initialState,
    reducers: {
        setUser: (state, { payload }) => {
            return payload;
        },
    }
});

export const selectUser = (state: any) => state.user;
export const { setUser } = userSlice.actions;

export default userSlice.reducer;