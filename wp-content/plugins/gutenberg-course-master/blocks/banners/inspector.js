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
    RadioControl,
    TextControl,
    TextareaControl,
    bannerType,
    mp4Url,
    webmUrl,
    imageUrl,
    formShortcode,
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
    }

    


    render() {
        const { attributes: { bannerType, mp4Url, webmUrl, imageUrl, formShortcode, heading, subheading }, setAttributes } = this.props;

        return (
            <InspectorControls>
               <PanelBody>
                    <RadioControl
                        label={ __( 'Image Position', 'jsforwpblocks' ) }
                        selected={ bannerType }
                        options={ [
                            { label: 'Small', value: 'small' },
                            { label: 'Big', value: 'big' },
                            
                        ] }
                        onChange={ bannerType => setAttributes( { bannerType } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'MP4 Url', 'jsforwpblocks' ) }
                        help={ __( 'MP4 Url', 'jsforwpblocks' ) }
                        value={ mp4Url }
                        onChange={ mp4Url => setAttributes( { mp4Url } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Webm Url', 'jsforwpblocks' ) }
                        help={ __( 'Webm Url', 'jsforwpblocks' ) }
                        value={ webmUrl }
                        onChange={ webmUrl => setAttributes( { webmUrl } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Background Image Url', 'jsforwpblocks' ) }
                        help={ __( 'Background Image Url', 'jsforwpblocks' ) }
                        value={ imageUrl }
                        onChange={ imageUrl => setAttributes( { imageUrl } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Form Shortcode', 'jsforwpblocks' ) }
                        help={ __( 'Form Shortcode', 'jsforwpblocks' ) }
                        value={ formShortcode }
                        onChange={ formShortcode => setAttributes( { formShortcode } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextareaControl
                        label={ __( 'Heading', 'jsforwpblocks' ) }
                        help={ __( 'Heading', 'jsforwpblocks' ) }
                        value={ heading }
                        onChange={ heading => setAttributes( { heading } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextareaControl
                        label={ __( 'Sub Heading', 'jsforwpblocks' ) }
                        help={ __( 'Sub Heading', 'jsforwpblocks' ) }
                        value={ subheading }
                        onChange={ subheading => setAttributes( { subheading } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
