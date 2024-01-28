const TextField = ({ label, ...register }) => {
  return (
    <div>
      <label>{label}</label>
      <input type="text" className="text-black" {...register} />
    </div>
  );
};

export default TextField;
