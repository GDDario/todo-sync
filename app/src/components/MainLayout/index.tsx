import { ReactNode } from "react";
import TopBar from "../TopBar";
import SideMenu from "../SideMenu";

type MainLayoutProps = {
    children: ReactNode
};

const MainLayout = ({ children }: MainLayoutProps) => {

    return (
        <div className="h-screen flex overflow-hidden">
            <SideMenu />
            <div className="inline-block w-full">
                <TopBar />
                <div className="overflow-y-auto max-h-[calc(100%-60px)]">
                   {children}
                </div>
            </div>

        </div>
    );
};

export default MainLayout;