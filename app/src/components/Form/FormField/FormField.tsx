type FormProps = {
    type: string;
    label: string;
    name: string;
    register: any;
    error: any;
    variant?: string;
};

const FormField = (
    {
        type,
        label,
        name,
        register,
        error,
        variant
    }: FormProps) => {
    const id: string = label + "_" + name;

    const styleClasses = () => {
        let classes = "text-black p-1 w-full rounded mt-1 ";

        switch (variant) {
            case undefined:
            case "default":
                break;
            case "bordered":
                classes += "border border-black";
                break;
        }

        return classes;
    };

    return (
        <div>
            <label form={id}>{label}</label>
            <input
                id={id}
                type={type}
                {...register(name)}
                className={styleClasses()}
            />
            {error && <p className="mt-0.5 text-[#ff4e4e]">{error?.message}</p>}
        </div>
    );
};

export default FormField;
