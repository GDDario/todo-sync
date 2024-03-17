type UserJSON = {
    uuid: string;
    username: string;
    email: string;
    created_at: string;
};

type FindUserByEmailResponse = {
    data: UserJSON

};

export type {FindUserByEmailResponse, UserJSON};