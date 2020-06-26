/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    TextControl,
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
            attributes: { heading, subheading },
            className, setAttributes  } = this.props;

        return (
                <h1>Schedules Will render on the front end</h1>
        );
    }
}
