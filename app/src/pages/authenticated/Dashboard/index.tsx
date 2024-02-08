import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { changePageName } from "../../../store/pageSlice";
import Block from "./Block";
import { BsFillEmojiWinkFill } from "react-icons/bs";
import { BsEmojiSunglassesFill } from "react-icons/bs";
import { BsFillEmojiSmileUpsideDownFill } from "react-icons/bs";
import { BsEmojiSurpriseFill } from "react-icons/bs";
import { BsEmojiDizzyFill } from "react-icons/bs";

const Dashboard = () => {
    const [isLoading, setLoading] = useState(false);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(changePageName('Dashboard'));
    }, []);

    return (
        <div className="flex flex-col gap-12 max-w-[1366px]">
            <div className="flex gap-12">
                <Block emoji={BsFillEmojiWinkFill} number={6} text="Total Todos" />
                <Block emoji={BsEmojiSunglassesFill} number={3} text="Completed Todos" />
                <Block emoji={BsFillEmojiSmileUpsideDownFill} number={3} text="Pending Todos" />
                <Block emoji={BsEmojiSurpriseFill} number={2} text="Urgent" />
                <Block emoji={BsEmojiDizzyFill} number={1} text="Out of time" />
            </div>

            <div className="border-mainColor border-2 p-4 rounded-[4px] h-[350px]">
                <h4 className="text-xl">Commitments</h4>
                Cool chart to be implemented
            </div>

            <div className="border-mainColor border-2 p-4 rounded-[4px] w-[50%]">
                <h4 className="text-xl">Most used tags</h4>
                <ol className="list-decimal ml-4 mt-4">
                    <li>Work: 50</li>
                    <li>Workout: 35</li>
                    <li>Family: 22</li>
                    <li>House: 9</li>
                    <li>Cat: 2</li>
                    <li>Dog: 1</li>
                </ol>
            </div>
        </div>
    );
};

export default Dashboard;
