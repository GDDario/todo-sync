import ModalBase from "../ModalBase"

type CreateTodoListModalProps = {
    onClose: () => void;
};

const CreateTodoListModal = ({onClose}) => {
    return (
        <ModalBase title="Create Todo List" onClose={() => onClose()}>
            <form>aoo</form>
        </ModalBase>
    );
};

export default CreateTodoListModal;