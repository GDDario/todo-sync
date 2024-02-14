import { ReactNode } from "react";

type ButtonProps = {
  value: string;
  isLoading?: boolean;
  variant?: string;
  icon?: ReactNode;
};

const Button = ({ value, isLoading, variant, icon }: ButtonProps) => {
  const styleClasses = () => {
    let classes = "mt-6 py-1 px-2 rounded min-w-[100px] ";

    if (icon) {
      classes += "flex justify-between items-center ";
    }

    switch (variant) {
      case undefined:
      case "default":
        classes += "bg-mainColor hover:bg-mainColorDarker text-appWhite";
        break;
      case "white":
        classes += "bg-appWhite text-black hover:bg-appWhiteDarker";
        break;
      case "danger":
        classes += "bg-appRed hover:bg-appRedDarker text-appWhite";
        break;
    }

    return classes;
  };

  return (
    <button
      className={styleClasses()}
      type="submit"
      disabled={isLoading}
    >
      {value}
      {isLoading && '...'}
      {icon}
    </button>
  );
};

export default Button;
