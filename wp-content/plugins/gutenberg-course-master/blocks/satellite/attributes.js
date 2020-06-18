const attributes = {
    bgimg: {
        type: 'string',
    },
    logoimg: {
        type: 'string',
    },
    heading: {
        type: 'string',
    },
    content: {
        type: 'string',
    },
    where: {
        type: 'string',
    },
    when: {
        type: 'string',
    },
    btnTitle: {
        type: 'string',
    },
    btnLink: {
        type: 'string',
    },
    imgURL: {
                type: 'string',
                source: 'attribute',
                attribute: 'src',
                selector: 'img',
            },
            imgID: {
                type: 'number',
            },
            imgAlt: {
                type: 'string',
                source: 'attribute',
                attribute: 'alt',
                selector: 'img',
            },
            
            imgURL2: {
                type: 'string',
                source: 'attribute',
                attribute: 'src',
                selector: 'img',
            },
            imgID2: {
                type: 'number',
            },
            imgAlt2: {
                type: 'string',
                source: 'attribute',
                attribute: 'alt',
                selector: 'img',
            },
};

export default attributes;
