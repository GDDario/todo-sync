import { createSlice } from "@reduxjs/toolkit";

const initialState: TodoList[] = [{
    uuid: '',
    name: '',
    is_collaborative: false,
    created_at: ''
}];

const todoListsSlice = createSlice({
    name: 'todoLists',
    initialState,
    reducers: {
        setTodoLists: (state, { payload }) => {
            state.splice(0, state.length, ...payload);
        },
        addTodoList: (state, { payload }) => {
            state.push(payload);
        },
    }
});

export const selectTodoLists = (state: any) => state.todoLists;
export const { setTodoLists, addTodoList } = todoListsSlice.actions;

export default todoListsSlice.reducer;
