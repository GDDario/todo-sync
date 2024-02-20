type FindUserByEmailResponse = {
    data: {
        uuid: string,
        username: string,
        email: string,
        created_at: string
    }
};

export type { FindUserByEmailResponse };