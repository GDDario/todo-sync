import {IoCloseCircle} from "react-icons/io5";
import {isColorDark} from "../../../utils/colorUtil.ts";

type props = {
    tag: Tag;
    onClick?: () => void;
    mini?: boolean;
};

const TagChip = ({tag, onClick, mini}: props) => {
    const textColor = (): string => {
        if (tag.color && isColorDark(tag.color)) {
            return "white";
        }

        return "black";
    }

    return (
        <div
            className={`tag-chip rounded-[7px] px-[6px] py-[1px] inline-flex cursor-pointer select-none ${mini && 'text-[11px]'}`}
            style={{backgroundColor: tag.color, color: textColor()}}
            onClick={onClick}>
            <span>
                {tag.name}
            </span>
            {
                !mini && <button className="ml-1" onClick={(e) => e.preventDefault()}>
                    <IoCloseCircle/>
                </button>
            }

        </div>
    );
};

export default TagChip;