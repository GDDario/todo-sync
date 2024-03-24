const isChildren = (child: any, father: any): boolean => {
    if (!child || !father) {
        return false;
    }

    if (child === father) {
        return true;
    }

    return isChildren(child.parentNode, father);
};

export {isChildren};