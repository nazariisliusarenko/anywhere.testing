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
    SelectControl,
    RadioControl,
    TextControl,
    TextareaControl,
    RangeControl,
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
        const { attributes: { selectControl, rangeControl, options, togglesType, heading, textareaDescription }, setAttributes } = this.props;

        return (
            <InspectorControls>
                <PanelBody>
                    <SelectControl
                        label={ __( 'Select Toogles Category', 'jsforwpblocks' ) }
                        value={ selectControl }
                        options={ this.state.options }
                        onChange={ selectControl => setAttributes( { selectControl } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <RangeControl
                        beforeIcon="arrow-left-alt2"
                        afterIcon="arrow-right-alt2"
                        label={ __( 'Range Control', 'jsforwpblocks' ) }
                        value={ rangeControl }
                        onChange={ rangeControl => setAttributes( { rangeControl } ) }
                        min={ 1 }
                        max={ 4 }
                    />
                </PanelBody>
                
                <PanelBody>
                    <RadioControl
                        label={ __( 'Toggle Type', 'jsforwpblocks' ) }
                        selected={ togglesType }
                        options={ [
                            { label: 'Regular', value: 'regular' },
                            { label: 'Inside White', value: 'insideWhite' },
                            { label: 'Background White', value: 'backgroundWhite' },
                        ] }
                        onChange={ togglesType => setAttributes( { togglesType } ) }
                    />
                </PanelBody>
                <PanelBody>
                    <TextControl
                        label={ __( 'Heading', 'jsforwpblocks' ) }
                        help={ __( 'Heading', 'jsforwpblocks' ) }
                        value={ heading }
                        onChange={ heading => setAttributes( { heading } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextareaControl
                        label={ __( 'Text Description', 'jsforwpblocks' ) }
                        help={ __( 'Text Description', 'jsforwpblocks' ) }
                        value={ textareaDescription }
                        onChange={ textareaDescription => setAttributes( { textareaDescription } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
