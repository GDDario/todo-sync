import { createSlice } from '@reduxjs/toolkit';

type PageType = {
    name: string;
}

const initialState: PageType = { name: 'Dashboard' };

const pageSlice = createSlice({
    name: 'page',
    initialState,
    reducers: {
        setName: (state, action) => {
            state.name = action.payload;
          },
    }
});

export const selectPage = (state) => state.page;
export const { setName } = pageSlice.actions;

export default pageSlice.reducer;