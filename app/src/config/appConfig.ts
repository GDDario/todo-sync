const themes: string[] = [
    "Cyan blue",
    "Brown",
    "Leaf green"
];

const fontFactors: string[] = [
    "50%",
    "75%",
    "100%",
    "125%",
    "150%",
];

const languages: string[] = [
    "English",
    "Português",
    "Español",
];

const getConfig = (configName: 'theme' | 'fontFactor' | 'language'): string => {
    const configs = {
        'theme': themes,
        'fontFactor': fontFactors,
        'language': languages
    };

    const config = configs[configName];

    console.log('configName', configName)
    const item = localStorage.getItem(configName);

    if (!item || !(configName in configs)) {
        localStorage.removeItem(configName);
        localStorage.setItem(configName, config[0]);
        return config[0];
    }

    return item;
}

export {themes, fontFactors, languages, getConfig};