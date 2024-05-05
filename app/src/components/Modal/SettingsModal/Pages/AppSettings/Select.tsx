interface Props {
    name: string;
    register: any;
    label: string;
    options: any[];
}

const Select = ({name, register, label, options}: Props) => {
    return (
        <div>
            <label htmlFor={name} className="mb-2 block">{label}</label>
            <select
                id={name}
                name={name}
                className="bg-transparent border border-appWhite rounded-[4px] focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-mainColor cursor-pointer"
                {...register(name)}
                defaultValue={options.filter((option) => option.isSelected)[0].uuid}
            >

                {
                    options.map((option: any, index: number) => {
                        return <option key={option.uuid ?? index} value={option.uuid}>{option.text}</option>;
                    })
                }
            </select>
        </div>
    );
};

export default Select;