import { createSlice } from '@reduxjs/toolkit';

export const messageSlice = createSlice({
    name: 'message',
    initialState: {
        message: null,
        type: null,
        duration: 3000,
    },
    reducers: {
        showMessage: (state, action) => {
            state.message = action.payload.message;
            state.type = action.payload.type;
            if (action.payload.duration) {
                state.duration = action.payload.duration;
            }
        },
        hideMessage: (state) => {
            state.message = null;
            state.type = null;
        },
    },
});

export const { showMessage, hideMessage } = messageSlice.actions;

export default messageSlice.reducer;