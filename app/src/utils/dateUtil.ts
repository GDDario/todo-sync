const pad = (number: number): string => {
    const padded = number < 10 ? '0' + number : number;
    return padded.toString();
}

export { pad };

