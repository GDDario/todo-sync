type FormProps = {
  type: string;
  label: string;
  name: string;
  variant?: string;
  register: any;
  error: any;
};

const FormField = ({
  type,
  label,
  name,
  register,
  error,
  variant
}: FormProps) => {

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
      <label>{label}</label>
      <input
        type={type}
        {...register(name)}
        className={styleClasses()}
      />
      {error && <p className="mt-0.5 text-[#ff4e4e]">{error?.message}</p>}
    </div>
  );
};

export default FormField;
