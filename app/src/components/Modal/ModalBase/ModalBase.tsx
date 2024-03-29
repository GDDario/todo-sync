import {MouseEvent, ReactNode, useEffect} from "react";

type ModalBaseProps = {
    title: string;
    children: ReactNode;
    onClose: () => void;
};

const ModalBase = ({ children, title, onClose }: ModalBaseProps) => {
    const handleClose = (event: MouseEvent<HTMLElement>) => {
        if (event.target == event.currentTarget) {
            onClose();
        }
    }

    useEffect(() => {
        document.addEventListener('keydown', (event: KeyboardEvent) => {
            if (event.key == 'Escape') {
                onClose();
            }
        });
    }, []);

    return (
        <div className="absolute top-0 left-0 z-[100] w-screen h-screen overflow-hidden flex justify-center items-center bg-black bg-opacity-55 text-black"
            onClick={(event: MouseEvent<HTMLElement>) => handleClose(event)}   >
            <div className="bg-appWhite py-4 px-6 rounded min-w-[30%] max-w-[1300px]">
                <h2 className="text-mainColor text-xl text-center">{title}</h2>
                <div className="my-4">
                    {children}
                </div>
            </div>
        </div>
    );
};

export default ModalBase;