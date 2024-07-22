const pad = (number: number): string => {
    const padded = number < 10 ? '0' + number : number;
    return padded.toString();
}

const getDateStringFromUTC = (date: Date): string => {
    const year: number = date.getUTCFullYear();
    const month: string = pad(date.getUTCMonth() + 1);
    const day: string = pad(date.getUTCDate());

    return `${year}-${month}-${day}`;
}

const getDateFromAmericanFormat = (dateString: string): Date => {
    const parts: string[] = dateString.split('-');
    const year : number= parseInt(parts[0], 10);
    const month: number = parseInt(parts[1], 10) - 1;
    const day: number = parseInt(parts[2], 10);

    return new Date(year, month, day);
}

const getInputDateTimeLocalFromUTCDate = (date: string) => {
    const dateObj: Date = new Date(date);

    return dateObj.toISOString().slice(0, 16);
}

const isTomorrow = (date: Date) => {
    const tomorrow: Date = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);

    return tomorrow.toDateString() == date.toDateString();
}

export {pad, getDateStringFromUTC, getDateFromAmericanFormat, isTomorrow, getInputDateTimeLocalFromUTCDate};