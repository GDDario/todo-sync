import { configureStore } from "@reduxjs/toolkit";
import userReducer from "./userSlice";
import pageReducer from "./pageSlice";

const store = configureStore(
    {
        reducer: {
            user: userReducer,
            page: pageReducer
        }
    }
);

export default store;