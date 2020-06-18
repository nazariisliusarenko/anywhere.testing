const attributes = {
    imagePosition: {
        type: 'string',
    },
    backgroundColor: {
        type: 'string',
    },
    heading: {
        type: 'string',
    },
    textareaDescription: {
        type: 'text',
    },
    btnName: {
        type: 'text',
    },
    btnLink: {
        type: 'text',
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
        youtubeLink: {
        type: 'text',
    },
    imgSrc: {
        type: 'text',
    }
};

export default attributes;
