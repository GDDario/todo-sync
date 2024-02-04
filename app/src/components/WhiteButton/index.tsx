type props = {
  value: string,
  isLoading: boolean
};

const WhiteButton = ({ value, isLoading }: props) => {
  return (
    <button
      className="mt-6 block mx-auto p-1 bg-slate-100 rounded w-[100px] text-black hover:bg-slate-200"
      type="submit"
      disabled={isLoading}
    >
      {value}
      {isLoading && '...'}
    </button>
  );
};

export default WhiteButton;
