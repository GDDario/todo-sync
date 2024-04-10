interface Props {
   name: string;
   label: string;
    options: string[];
}

const Select = ({name, label, options}: Props) => {
    return (
        <div>
            <label htmlFor={name} className="mb-2 block">{label}</label>
            <select id={name}
                    name={name}
                    className="bg-transparent border border-appWhite rounded-[4px] focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-mainColor">
                <option selected>Choose a country</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
            </select>
        </div>
    );
};

export default Select;