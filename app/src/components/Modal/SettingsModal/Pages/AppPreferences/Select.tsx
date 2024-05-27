interface Props {
    name: string;
    register: any;
    label: string;
    options: string[];
    defaultOption: string;
}

const Select = ({name, register, label, options, defaultOption}: Props) => {
    return (
        <div>
            <label htmlFor={name} className="mb-2 block">{label}</label>
            <select
                id={name}
                name={name}
                className="bg-transparent border border-appWhite rounded-[4px] focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-mainColor cursor-pointer"
                {...register(name)}
                defaultValue={options.filter((opt) => opt === defaultOption)[0]}
            >

                {
                    options.map((option: string, index: number) => {
                        return <option key={index} value={option}>{option}</option>;
                    })
                }
            </select>
        </div>
    );
};

export default Select;