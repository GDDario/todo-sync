type RegisterCredentials = {
    username: string;
    email: string;
    password: string;
    password_confirmation: string;
};

type RegisterResponse = {
    data: {
        uuid: string,
        username: string,
        email: string,
        created_at: string
    }
};

type LoginCredentials = {
    email: string;
    password: string;
};

type LoginResponse = {
    data: {
        user: {
            uuid: string,
            username: string,
            email: string
        },
        token: string
    }
};

type TokenLoginCredentials = {
    token: string
};

export type { RegisterCredentials, RegisterResponse, LoginCredentials, LoginResponse, TokenLoginCredentials };