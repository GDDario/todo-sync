import { z } from "zod";
import FormField from "../../Form/FormField";
import ModalBase from "../ModalBase"
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import Button from "../../Button";
import { IoMdClose, IoMdSearch, IoMdCloseCircle } from "react-icons/io";
import { FaCheck } from "react-icons/fa6";
import { useEffect, useState } from "react";
import CollaboratorContainer from "./CollaboratorContainer";
import { searchUserByEmail } from "../../../services/user/userService";
import { useDispatch, useSelector } from "react-redux";
import { selectUser } from "../../../store/userSlice";
import { createTodoList } from "../../../services/todo/todoListService";
import { addTodoList, selectTodoLists } from "../../../store/todoListsSlice";

type CreateTodoListModalProps = {
    onClose: () => void;
};

const schema = z.object({
    name: z.string().min(3),
    isCollaborative: z.boolean()
});

type createTodoListSchema = z.infer<typeof schema>;

const CreateTodoListModal = ({ onClose }: CreateTodoListModalProps) => {
    const {
        register,
        handleSubmit,
        setError,
        formState: { errors },
    } = useForm<createTodoListSchema>({ resolver: zodResolver(schema) });
    const [showCollaborators, setShowCollaborators] = useState<boolean>(false);
    const [collaborators, setCollaborators] = useState<User[]>([]);
    const [email, setEmail] = useState<string>('');
    const [loading, setLoading] = useState<boolean>(false);
    const [searchError, setSearchError] = useState<string>('');
    const user = useSelector(selectUser);
    const dispatch = useDispatch();

    useEffect(() => {
        document.addEventListener('click', (e) => {
            const target = e.target as HTMLElement; // Converte o tipo genérico para HTMLElement
            const id = target.id; // Obtém o ID do elemento alvo

            if (id !== 'searchButton') {
                setSearchError('');
            }
        });
    }, []);

    const handleSearchCollaborator = async () => {
        setLoading(true);

        if (email === user.email) {
            setSearchError('You cannot add yourself.');
            return;
        }

        try {
            const collaboratorData = await searchUserByEmail(email);
            const collaborator: User = collaboratorData.data.data;

            for (let i = 0; i < collaborators.length; i++) {
                if (collaborator.uuid == collaborators[i].uuid) {
                    setSearchError('Collaborator already in.');
                    return;
                }
            }

            setCollaborators(collaborators => [...collaborators, collaborator]);
        } catch (error: any) {
            setSearchError('Collaborator not found.');
        } finally {
            setLoading(false);
        }
    };

    const handleRemoveCollaborator = (uuid: string) => {
        const filteredCollaborators = collaborators.filter((collaborator: User) => {
            return collaborator.uuid != uuid;
        });

        setCollaborators(filteredCollaborators);
    }

    const onSubmit = async ({ name, isCollaborative }: createTodoListSchema) => {
        let collaboratorsUuids: string[] = [];

        if (isCollaborative) {
            collaboratorsUuids = collaborators.map((collaborator: User) => {
                return collaborator.uuid;
            });
        }

        try {
            const todoListData = await createTodoList({ name, isCollaborative, collaboratorsUuids });
            dispatch(addTodoList(todoListData.data.data));
            // TODO: Success message
            onClose();
        } catch (error: any) {
            const errors = error?.response?.data?.errors;
            if (errors) {
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        setError(key as keyof createTodoListSchema,
                            {
                                type: 'manual',
                                message: errors[key][0]
                            }
                        );
                    }
                }
            }
            // TODO: Error message
        } finally {
            setLoading(false);
        }
    }

    return (
        <ModalBase title="Create Todo List" onClose={() => onClose()}>
            <form onSubmit={handleSubmit(onSubmit)}>
                <FormField
                    type="text"
                    label="Name"
                    name="name"
                    variant="bordered"
                    register={register}
                    error={errors.name}
                />

                <div className="flex items-center gap-2 mt-2">
                    <input
                        type="checkbox"
                        id="isCollaborative"
                        {...register("isCollaborative")}
                        onChange={(event) => setShowCollaborators(event?.target.checked)}
                        className="block w-[16px] h-[16px]" />
                    <label htmlFor="isCollaborative" className="select-none">Collaborative</label>
                </div>

                {
                    showCollaborators &&
                    <div className="mt-4">
                        <div className="flex gap-2 items-center justify-start">
                            <input
                                type="text"
                                placeholder="Put the collaborator email here"
                                className="px-2 py-1 border border-black rounded"
                                onChange={(event: React.ChangeEvent<HTMLInputElement>) => setEmail(event.target.value)}
                            />
                            <Button id="searchButton" type="button" onClick={() => handleSearchCollaborator()} value="Search" isLoading={false} icon={<IoMdSearch size={20} />} />
                        </div>
                        {searchError && <p className="text-red-500">{searchError}</p>}

                        <div className="mt-3">
                            {
                                collaborators.map((collaborator: User) =>
                                    <CollaboratorContainer
                                        key={collaborator.uuid}
                                        collaborator={collaborator}
                                        onRemove={handleRemoveCollaborator}
                                    />)
                            }
                        </div>
                    </div>
                }

                <div className="flex justify-end items-end gap-2 mt-6">
                    <Button
                        value="Cancel"
                        type="button"
                        variant="danger"
                        icon={<IoMdClose size={20} />}
                        onClick={(e) => onClose()}
                    />
                    <Button
                        value="Confirm"
                        type="submit"
                        icon={<FaCheck size={18} />}
                    />
                </div>
            </form>
        </ModalBase>
    );
};

export default CreateTodoListModal;