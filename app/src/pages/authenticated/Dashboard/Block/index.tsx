import React from 'react';

type BlockProps = {
    emoji: React.ElementType;
    number: number;
    text: string;
    textSize?: number;
};

const Block: React.FC<BlockProps> = ({ emoji: Emoji, number, text, textSize }) => {
    return (
        <div className="border-mainColor border-2 p-4 rounded-[4px] h-[170px] w-[200px] flex flex-col justify-between relative overflow-hidden">
            <div className="absolute top-[-45%] left-[-45%] bg-mainColor w-full h-full rounded-full"></div>
            <Emoji size={28} className="absolute top-[14%] left-[14%] text-appWhite" />
            <span className="text-8xl block text-right">{number}</span>
            <p className={`text-xl text-nowrap ${textSize && `text-[${textSize}px]`}`}>{text}</p>

        </div>
    );
};

export default Block;