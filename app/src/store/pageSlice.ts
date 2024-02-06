import { createSlice } from '@reduxjs/toolkit';

type PageType = {
    name: string;
}

const initialState: PageType = { name: 'hulului' };

const pageSlice = createSlice({
    name: 'page',
    initialState,
    reducers: {
        changePageName: (state, action) => {
            state.name = action.payload;
          },
    }
});

export const selectPage = (state) => state.page;
export const { changePageName } = pageSlice.actions;

export default pageSlice.reducer;