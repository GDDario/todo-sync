import {Provider} from "react-redux";
import store from "./store";
import router from "./router";
import {RouterProvider} from "react-router-dom";
import Message from "./components/Message/Message.tsx";

const App = () => {
    return (
        <Provider store={store}>
            <Message />
            <RouterProvider router={router}/>
        </Provider>
    );
}

export default App;