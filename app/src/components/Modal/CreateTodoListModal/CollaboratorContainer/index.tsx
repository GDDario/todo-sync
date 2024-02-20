import { HiUserCircle } from "react-icons/hi2";
import { IoMdCloseCircle } from "react-icons/io";

type CollaboratorContainerProps = {
    collaborator: User;
    onRemove: (uuid: string) => void;
};

const CollaboratorContainer = (props: CollaboratorContainerProps) => {
    return (
        <div className="px-2 py-1 flex justify-between items-center bg-mainColor rounded text-appWhite mt-1">
            <div className="flex justify-center items-center gap-6">
                <HiUserCircle size={40} />
                <div className="flex flex-col text-[14px]">
                    <label>{props.collaborator.username}</label>
                    <label>{props.collaborator.email}</label>
                </div>
            </div>
            <IoMdCloseCircle className="cursor-pointer text-[24px] hover:text-appWhiteDarker" onClick={() => props.onRemove(props.collaborator.uuid)} />
        </div>
    );
};

export default CollaboratorContainer;