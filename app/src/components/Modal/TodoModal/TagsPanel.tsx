import TagChip from "./TagChip.tsx";

type props = {
    tags: Tag[];
    callback: (tag: Tag) => void;
};

const TagsPanel = ({tags, callback}: props) => {
    return (
        <div id="tags-panel"
             className="absolute top-[110%] left-0 flex flex-wrap gap-2 bg-appWhite border-black border border-t-0 p-2 w-full shadow-md"
        >
            {
                tags.map((tag) => {
                    return (
                        <TagChip key={tag.uuid} tag={tag} onClick={() => callback(tag)}/>
                    );
                })
            }
        </div>
    );
};

export default TagsPanel;