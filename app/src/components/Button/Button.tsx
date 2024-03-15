import {ReactNode} from "react";

type ButtonProps = {
    value: string;
    id?: string;
    type?: "button" | "submit" | "reset" | undefined;
    variant?: "default"|"white"|"danger"|"underline";
    icon?: ReactNode;
    onClick?: (e?) => void
    isLoading?: boolean;
};

const Button = ({id, value, type, variant, icon, onClick, isLoading}: ButtonProps) => {
    const styleClasses = () => {
        let classes = "py-1 px-2 rounded min-w-[100px] disabled:opacity-80 ";

        if (icon) {
            classes += "flex justify-between items-center ";
        }

        switch (variant) {
            case undefined:
            case "default":
                classes += "bg-mainColor hover:bg-mainColorDarker text-appWhite";
                break;
            case "white":
                classes += "bg-appWhite text-black hover:bg-appWhiteDarker";
                break;
            case "danger":
                classes += "bg-appRed hover:bg-appRedDarker text-appWhite";
                break;
            case "underline":
                classes += "bg-transparent hover:bg-black hover:bg-opacity-10 border-b-2 border-gray-800";
                break;
        }

        return classes;
    };

    return (
        <button
            id={id}
            className={styleClasses()}
            type={type ?? 'submit'}
            disabled={isLoading}
            onClick={(e) => onClick && onClick(e)}
        >
            {value}
            {isLoading && '...'}
            {icon}
        </button>
    );
};

export default Button;
