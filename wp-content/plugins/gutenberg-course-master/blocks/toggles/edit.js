/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    CheckboxControl,
    RadioControl,
    TextControl,
    TextareaControl,
    SelectControl
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const {
            attributes: { checkboxControl, radioControl, textControl, textareaControl, selectControl },
            className, setAttributes  } = this.props;

        return (
                <h1>Will render on the front end</h1>
        );
    }
}
