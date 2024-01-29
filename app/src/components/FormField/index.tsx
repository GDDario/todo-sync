type formParams = {
  type: string;
  label: string;
  name: string;
  register: any;
  error: any;
};

const FormField = ({
  type,
  label,
  name,
  register,
  error
}: formParams ) => {
  return (
    <div>
      <label>{label}</label>
      <input
        type={type}
        {...register(name)}
        className="text-black p-1 w-full rounded mt-1"
      />
      {error && <p className="mt-0.5 text-[#ff4e4e]">{error?.message}</p>}
    </div>
  );
};

export default FormField;
