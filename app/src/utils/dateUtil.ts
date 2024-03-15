const pad = (number: number): string => {
    const padded = number < 10 ? '0' + number : number;
    return padded.toString();
}

const getDateFromUTC = (date: Date): string => {
    const year: number = date.getUTCFullYear();
    const month: string = pad(date.getUTCMonth() + 1);
    const day: string = pad(date.getUTCDate());

    return `${year}-${month}-${day}`;
}

export { pad, getDateFromUTC };
