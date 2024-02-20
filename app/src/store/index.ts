import { configureStore } from "@reduxjs/toolkit";
import userReducer from "./userSlice";
import pageReducer from "./pageSlice";
import todoListsSlice from "./todoListsSlice";

const store = configureStore(
    {
        reducer: {
            user: userReducer,
            todoLists: todoListsSlice,
            page: pageReducer
        }
    }
);

export default store;