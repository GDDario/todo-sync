const WhiteButton = ({ value }: { value: string }) => {
  return (
    <button
      className="mt-6 block mx-auto p-1 bg-slate-100 rounded w-[100px] text-black hover:bg-slate-200"
      type="submit"
    >
      {value}
    </button>
  );
};

export default WhiteButton;
