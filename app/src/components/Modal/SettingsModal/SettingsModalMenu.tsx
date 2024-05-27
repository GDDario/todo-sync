import {MenuItem} from "./types.ts";

type Props = {
    menuItems: MenuItem[];
    handleSelect: (menuItem: MenuItem) => void;
};

const SettingsModalMenu = ({menuItems, handleSelect}: Props) => {
    return (
        <ul className="mt-2 flex flex-col gap-2">
            {
                menuItems.map((item) => {
                    const classes = `flex w-full items-center gap-2 text-appWhite p-1 rounded-[4px] ${item.isSelected && 'bg-appWhite text-mainColor'} hover:bg-appWhite hover:text-mainColor`;

                    return (
                        <li key={item.title} className="flex items-center gap-1">
                            <button
                                onClick={() => handleSelect(item)}
                                className={classes}>
                                <span>
                                    {item.icon}
                                </span>
                                <p className="text-nowrap">
                                    {item.title}
                                </p>
                            </button>
                        </li>
                    );
                })
            }
        </ul>
    );
};

export default SettingsModalMenu;