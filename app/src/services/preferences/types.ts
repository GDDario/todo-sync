type GetUserPreferencesResponse = {
    data: {
        themes: Theme;
        languages: Language;
        font_factors: FontFactor;
    };
}

type GetAllPreferencesResponse = {
    data: {
        themes: Theme[];
        languages: Language[];
        font_factors: FontFactor[];
    };
}

type UpdateUserPreferencesBody = {
    theme_uuid: string;
    language_uuid: string;
    font_factor_uuid: string;
}

export type {GetUserPreferencesResponse, GetAllPreferencesResponse, UpdateUserPreferencesBody};