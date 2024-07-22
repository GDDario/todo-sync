import Button from "../../Button/Button.tsx";
import {IoMdClose} from "react-icons/io";
import {FaCheck} from "react-icons/fa6";

type ModalButtonsProps = {
    loading?: boolean,
    onClose: () => void
};

const ModalButtons = ({loading, onClose}: ModalButtonsProps) => {
    return (
        <div className="flex justify-end items-end gap-2 mt-6">
            <Button
                isLoading={loading}
                value="Cancel"
                type="button"
                variant="danger"
                icon={<IoMdClose size={20}/>}
                onClick={() => onClose()}
            />
            <Button
                isLoading={loading}
                value="Confirm"
                type="submit"
                icon={<FaCheck size={18}/>}
            />
        </div>
    );
};

export default ModalButtons;