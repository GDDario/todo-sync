import {useEffect, useState} from "react";
import {useDispatch} from "react-redux";
import {changePageName} from "../../../store/pageSlice";
import DashboardBlock from "./Block/DashboardBlock.tsx";
import {
    BsEmojiDizzyFill,
    BsEmojiSunglassesFill,
    BsEmojiSurpriseFill,
    BsFillEmojiSmileUpsideDownFill,
    BsFillEmojiWinkFill
} from "react-icons/bs";
import {getDashboardData} from "../../../services/todo/dashboardService.ts";
import {
    DashboardTag,
    DashboardTodos,
    DashboardType,
    GetDashboardResponse
} from "../../../services/todo/types.ts";
import ReactApexChart from 'react-apexcharts';
import {pad} from "../../../utils/dateUtil.ts";
import {AxiosResponse} from "axios";

const initialDashboardState: DashboardType = {
    todos: {
        total: 0,
        completed: 0,
        pending: 0,
        urgent: 0,
        timed_out: 0
    },
    commitments: [],
    most_used_tags: []
};

const defaultChartData = {
    options: {
        chart: {
            id: 'Commitments Chart'
        },
        xaxis: {
            categories: [],
        },
        yaxis: {}
    },
    series: [
        {
            name: "Number of commitments",
            data: []
        }
    ],
    toolbar: {
        show: false
    }
};

const DashboardPage = () => {
    const [isLoading, setLoading] = useState(true);
    const dispatch = useDispatch();
    const [todos, setTodos] = useState<DashboardTodos>(initialDashboardState.todos);
    const [commitments, setCommitments] = useState<any>(defaultChartData);
    const [tags, setTags] = useState<DashboardTag[]>(initialDashboardState.most_used_tags);

    const getData = async () => {
        const responseData: AxiosResponse<GetDashboardResponse> = await getDashboardData();
        const dashboardData: DashboardType = responseData.data.data;
        const seriesData: number[] = [];
        const categoriesData: string[] = [];

        dashboardData.commitments.forEach((commitment) => {
            seriesData.push(commitment.count);
            const day: string = pad(new Date(commitment.due_date).getDate());
            categoriesData.push(`Day ${day}`);
        });

        const commitments = {
            ...defaultChartData,
            series: [{
                name: 'Number of commitments',
                data: seriesData
            }],
        }

        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        commitments.options.xaxis.categories = categoriesData;

        setTodos(dashboardData.todos);
        setCommitments(commitments);
        setTags(dashboardData.most_used_tags);
    }

    useEffect(() => {
        dispatch(changePageName('DashboardPage'));

        getData().then(() => {
            setLoading(false);
        });
    }, [dispatch]);

    return (
        <div className="flex flex-col gap-12 max-w-[1920px]">
            <div className="flex gap-12">
                <DashboardBlock emoji={BsFillEmojiWinkFill} number={todos?.total} text="Total Todos"/>
                <DashboardBlock emoji={BsEmojiSunglassesFill} number={todos?.completed} text="Completed Todos"/>
                <DashboardBlock emoji={BsFillEmojiSmileUpsideDownFill} number={todos?.pending}
                                text="Pending Todos"/>
                <DashboardBlock emoji={BsEmojiSurpriseFill} number={todos?.urgent} text="Urgent"/>
                <DashboardBlock emoji={BsEmojiDizzyFill} number={todos?.timed_out} text="Timed out"/>
            </div>

            {!isLoading &&
                <div className="border-mainColor border-2 p-4 rounded-[4px] h-[350px]">
                    <h4 className="text-xl">Commitments</h4>
                    <ReactApexChart options={commitments.options} series={commitments.series} type="line" height={300}/>
                </div>}

            <div className="border-mainColor border-2 p-4 rounded-[4px] w-[50%]">
                <h4 className="text-xl">Most used tags</h4>
                <ol className="list-decimal ml-4 mt-4">
                    {tags?.map((tag: DashboardTag) => {
                        return <li key={`${tag.name}-${tag.usage_count}`}>{tag.name}: <b>{tag.usage_count}</b></li>;
                    })}
                </ol>
            </div>
        </div>
    );
};

export default DashboardPage;
