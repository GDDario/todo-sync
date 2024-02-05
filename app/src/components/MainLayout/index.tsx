import { ReactNode } from "react";
import TopBar from "../TopBar";
import SideMenu from "../SideMenu";

type MainLayoutProps = {
    children: ReactNode
};

const MainLayout = ({ children }: MainLayoutProps) => {

    return (
        <div className="min-h-screen flex">
            <SideMenu />
            <div className="inline-block w-full">
                <TopBar />
                <div className="h-[calc(100%-60px)]">
                    {children}
                </div>
            </div>
        </div>
    );
};

export default MainLayout;