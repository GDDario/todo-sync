import React from "react";
import ReactDOM from "react-dom/client";
import "./index.css";
import App from "./App";
import store from "./store";
import {Provider} from "react-redux";
import './config/i18n';

ReactDOM.createRoot(document.getElementById("root")!).render(
  // <React.StrictMode>
        <Provider store={store}>
            <App/>
        </Provider>
  // </React.StrictMode>
);
