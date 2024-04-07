import ModalBase from "../ModalBase/ModalBase";

type props = {
    onClose: () => void;
};

const SettingsModal = ({onClose}: props) => {
    return (
        <div>
            <ModalBase title="Settings" onClose={() => onClose()}>
                Olá
            </ModalBase>
        </div>
    );
};

export default SettingsModal;