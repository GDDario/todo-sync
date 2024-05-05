import { configureStore } from "@reduxjs/toolkit";
import userReducer from "./userSlice";
import pageReducer from "./pageSlice";
import todoListsSlice from "./todoListsSlice";
import messageSlice from "./messageSlice";
import preferencesSlice from "./preferencesSlice.ts";

const store = configureStore(
    {
        reducer: {
            user: userReducer,
            todoLists: todoListsSlice,
            page: pageReducer,
            message: messageSlice,
            preferences: preferencesSlice
        }
    }
);

export default store;