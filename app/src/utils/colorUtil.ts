const isColorDark = (hexColor: string): boolean => {
    if (hexColor.charAt(0) === '#') {
        hexColor = hexColor.substring(1);
    }

    const r: number = parseInt(hexColor.substring(0, 2), 16);
    const g: number = parseInt(hexColor.substring(2, 4), 16);
    const b: number = parseInt(hexColor.substring(4, 6), 16);

    const luminance: number = (r * 299 + g * 587 + b * 114) / 1000;

    return luminance < 128;
};

export {isColorDark};