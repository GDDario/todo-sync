import {useEffect, useState} from "react";
import TagChip from "./TagChip.tsx";
import {FiPlus} from "react-icons/fi";
import {getAllTags} from "../../../services/tag/tagService.ts";
import TagsPanel from "./TagsPanel.tsx";
import {isChildren} from "../../../utils/domUtil.ts";

type props = {
    todoTags: Tag[];
    callback: (tag: Tag) => void;
};

const TagsSelect = ({todoTags, callback}: props) => {
    const [showTagsPanel, setShowTagsPanel] = useState(false);
    const [tags, setTags] = useState<Tag[]>([]);
    const [selectedTags, setSelectedTags] = useState<Tag[]>([]);

    useEffect(() => {
        fetchTags();
    }, []);

    useEffect(() => {
        setSelectedTags(todoTags);
    }, [todoTags]);

    useEffect(() => {
        window.addEventListener('click', onClick);

        return () => window.removeEventListener('click', onClick);
    }, [showTagsPanel]);

    const fetchTags = async (): Promise<void> => {
        const response = await getAllTags();
        setTags(response.data.data);
    };

    const onClick = (event) => {
        const parentNode = document.getElementById('tags-panel');
        const target = event.target;

        console.log(showTagsPanel && !isChildren(target, parentNode))
        if (showTagsPanel && !isChildren(target, parentNode)
            && target.id !== 'show-panel' && !target.classList.contains('tag-chip')) {
            setShowTagsPanel(false);
        }
    };

    return (
        <div className="relative max-w-full">
            <label>Tags</label>
            <div
                className="text-black p-1 rounded mt-1 border border-black bg-white min-h-[36px] flex justify-between items-stretch flex-wrap">
                <div className="flex gap-2 py-1 px-2 flex-wrap max-w-[80%]">
                    {
                        tags.length === 0
                            ? <p>...</p>
                            : selectedTags.map((tag: Tag) => {
                                return <TagChip key={tag.uuid} tag={tag} onClick={() => callback(tag)}/>
                            })
                    }
                </div>
                <button id="show-panel" className="flex items-center" onClick={(e) => {
                    e.preventDefault();
                    setShowTagsPanel(!showTagsPanel);
                }}>
                    Add more
                    <FiPlus className="ml-1"/>
                </button>
            </div>

            {
                showTagsPanel && <TagsPanel callback={callback} tags={tags}/>
            }
        </div>
    );
};

export default TagsSelect;