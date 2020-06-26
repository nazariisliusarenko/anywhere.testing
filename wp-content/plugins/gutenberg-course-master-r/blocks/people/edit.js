/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    TextControl,
    SelectControl,
    heading,
    subheading
} = wp.components;
import apiFetch from '@wordpress/api-fetch';
import ReactHtmlParser from 'react-html-parser';
/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const {
            attributes: { selectControl, heading, subheading },
            className, setAttributes  } = this.props;
            
 
            
        return (
            <div className={className}>
<section class="speakers">
    <header class="clearfix">
        <h1>{this.props.heading}</h1>
        <span>{this.props.subheading}</span>
        </header>
        <div class="dd">
        <h1>Will be rendered on the front end </h1>
        </div>
          <br/>
        <div class="align-center">
            <a class="btn btn-md-2 morespeakers" href="#">See More Speakers</a>
        </div>
</section>
</div>
        );
    }
}
