import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";

type UserType = {
    uuid: string;
    email: string;
    username: string;
}

export const loginUser = createAsyncThunk<UserType>(
    'user/loginUser',
    async (userData: any) => {
        return userData;
    }
)

const initialState: UserType = {
    uuid: '',
    username: '',
    email: ''
};

const userSlice = createSlice({
    name: 'user',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder.addCase(loginUser.fulfilled, (state, action) => {
            state.uuid = action.payload.uuid;
            state.email = action.payload.email;
            state.username = action.payload.username;
        });
    }
});

export const selectUser = (state) => state.user;

export default userSlice.reducer;