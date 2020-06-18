/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    InspectorControls,
    ColorPalette,
} = wp.editor;
const {
    PanelBody,
    TextControl,
} = wp.components;

import apiFetch from '@wordpress/api-fetch';
/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
        this.state = { options: [
                        { value: '...', label: 'Loading ...' },
                    ] }
        //this.getCategories = this.getCategories.bind(this);
        
        //this.getCategories();
    }
    
    // method to get the categories 
    getCategories() {
    apiFetch( { path: '/wp-json/wp/v2/categories/?parent=37' } ).then( posts => {
    
    var options = [];
    var option;
    
    for(var i = 0; i<posts.length;i++) {
        option = { value: posts[i].id.toString() , label: posts[i].name.toString() };
        options.push(option);
    }
    this.setState({
            options: options
        });

   
    } );
    }

    render() {
        const { attributes: {  options, heading, subheading }, setAttributes } = this.props;

        return (
            <InspectorControls>
                 <PanelBody>
                    <TextControl
                        label={ __( 'Title', 'jsforwpblocks' ) }
                        help={ __( 'Title', 'jsforwpblocks' ) }
                        value={ heading }
                        onChange={ heading => setAttributes( { heading } ) }
                    />
                </PanelBody>
                
                 <PanelBody>
                    <TextControl
                        label={ __( 'Sub Title', 'jsforwpblocks' ) }
                        help={ __( 'Sub Title', 'jsforwpblocks' ) }
                        value={ subheading }
                        onChange={ subheading => setAttributes( { subheading } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
