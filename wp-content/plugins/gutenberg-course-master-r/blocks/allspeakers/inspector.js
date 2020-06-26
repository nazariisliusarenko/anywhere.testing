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
    subheading
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
                    ],
                    options2: [
                        { value: '...', label: 'Loading ...' },
                    ]}
        this.getCategories = this.getCategories.bind(this);
        this.getCategories2 = this.getCategories2.bind(this);
        
        this.getCategories();
        this.getCategories2();
    }
    
    // method to get the categories 
    getCategories() {
    apiFetch( { path: '/wp-json/wp/v2/categories/?parent=18' } ).then( posts => {
    
    var options = [];
    var option;
    option = { value: 18 , label: "Conferences Filters" };
    options.push(option);
    for(var i = 0; i<posts.length;i++) {
        option = { value: posts[i].id.toString() , label: posts[i].name.toString() };
        options.push(option);
    }
    this.setState({
            options: options
        });

   
    });
    }
    
        // method to get the categories 
    getCategories2() {
    apiFetch( { path: '/wp-json/wp/v2/categories/?parent=32' } ).then( posts => {
    
    var options = [];
    var option;
    option = { value: 32 , label: "People Filters" };
    options.push(option);
    for(var i = 0; i<posts.length;i++) {
        option = { value: posts[i].id.toString() , label: posts[i].name.toString() };
        options.push(option);
    }
    this.setState({
            options2: options
        });

   
    });
    }

    render() {
        const { attributes: { selectControl, selectControl2, heading, subheading ,options}, setAttributes } = this.props;

        return (
            <InspectorControls>
                <PanelBody>
                    <SelectControl
                        label={ __( 'Select Filter', 'jsforwpblocks' ) }
                        value={ selectControl }
                        options={ this.state.options }
                        onChange={ selectControl => setAttributes( { selectControl } ) }
                    />
                </PanelBody>
                <PanelBody>
                    <SelectControl
                        label={ __( 'Select People', 'jsforwpblocks' ) }
                        value={ selectControl2 }
                        options={ this.state.options2 }
                        onChange={ selectControl2 => setAttributes( { selectControl2 } ) }
                    />
                </PanelBody>
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
