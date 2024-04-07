import {ReactNode} from "react";
import TopBar from "../TopBar/TopBar.tsx";
import SideMenu from "../SideMenu/SideMenu.tsx";

type MainLayoutProps = {
    children: ReactNode
};

const MainLayout = ({children}: MainLayoutProps) => {

    return (
        <div id="MainLayout" className="h-screen flex overflow-hidden bg-appWhite">
            <SideMenu/>
            <div className="inline-block w-full">
                <TopBar/>
                <div className="overflow-y-auto max-h-[calc(100%-60px)]">
                    {children}
                </div>
            </div>

        </div>
    );
};

export default MainLayout;