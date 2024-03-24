import {ReactElement} from "react";
import {isColorDark} from "../../utils/colorUtil.ts";

type props = {
    text: string;
    backgroundColor?: string;
    icon?: ReactElement;
    onClick?: () => void;
};

const Chip = ({text, backgroundColor = "#0C88A4", icon, onClick}: props) => {
    const textColor = (): string => {
        if (backgroundColor && isColorDark(backgroundColor)) {
            return "white";
        }

        return "black";
    }

    return (
        <div
            className="rounded-[7px] px-[6px] py-[1px] inline-flex cursor-pointer select-none"
            style={{backgroundColor: backgroundColor, color: textColor()}}
            onClick={onClick}
        >
            {icon && <div className="mr-1">{icon}</div>}
            <span className={`text-[11px]`}>{text}</span>
        </div>
    );
};

export default Chip;