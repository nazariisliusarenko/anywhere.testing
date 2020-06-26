/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    TextControl,
    SelectControl,
    heading
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
            attributes: { selectControl, mp4Url, webmUrl, formShortcode },
            className, setAttributes  } = this.props;
            const {videobg } = "mp4: " + this.props.attributes.mp4Url + ", webm: " + this.props.attributes.webmUrl;
 
            
        return (


       <div class="section hero-section"  data-vide-bg={videobg} data-vide-options="posterType: jpg, loop: true, muted: true">
         <div class="beforeVideo">
           <video autoplay="" loop="" muted="">
             <source src={this.props.attributes.mp4Url} type="video/mp4" />
             <source src={this.props.attributes.mp4Url} type="video/webm" />
             </video>
             </div>
	<div class="section-contents theme-dark">
			<section class="techFestivalForm">
            <h1>{this.props.attributes.heading}</h1>
            <p>{this.props.attributes.subheading}</p>
          </section>
	</div>
</div>


        );
    }
}
