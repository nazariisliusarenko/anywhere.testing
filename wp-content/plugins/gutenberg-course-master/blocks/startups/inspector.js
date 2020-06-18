/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    InspectorControls,
} = wp.editor;
const {
    PanelBody,
    SelectControl,
    TextControl,
    heading,
    categories
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
        this.getCategories = this.getCategories.bind(this);
        
        this.getCategories();
    }

    
    // method to get the categories 
    getCategories() {
    apiFetch( { path: '/wp-json/wp/v2/categories/?parent=579' } ).then( posts => {
    
    var options = [];
    var option = { value:579, label: "All Startups" };
    options.push(option);
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
        const { attributes: { selectControl, heading }, setAttributes } = this.props;

        return (
            <InspectorControls>
                <PanelBody>
                    <SelectControl
                        label={ __( 'Select Partners Category', 'jsforwpblocks' ) }
                        value={ selectControl }
                        options={ this.state.options }
                        onChange={ selectControl => setAttributes( { selectControl } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Sub Title', 'jsforwpblocks' ) }
                        help={ __( 'Sub Title', 'jsforwpblocks' ) }
                        value={ heading }
                        onChange={ heading => setAttributes( { heading } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
