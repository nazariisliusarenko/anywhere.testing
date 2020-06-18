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
    TextControl,
    TextareaControl,
    imgID, imgURL, imgAlt , imgID2, imgURL2, imgAlt2 , bgimg, logoimg, heading, content, where, when, btnTitle, btnLink
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const { attributes: { imgID, imgURL, imgAlt , imgID2, imgURL2, imgAlt2 , bgimg, logoimg, heading, content, where, when, btnTitle, btnLink }, setAttributes } = this.props;

        return (
            <InspectorControls>
               
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
                        label={ __( 'Content', 'jsforwpblocks' ) }
                        help={ __( 'Content', 'jsforwpblocks' ) }
                        value={ content }
                        onChange={ content => setAttributes( { content } ) }
                    />
                </PanelBody>
                
               
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Where', 'jsforwpblocks' ) }
                        help={ __( 'Where', 'jsforwpblocks' ) }
                        value={ where }
                        onChange={ where => setAttributes( { where } ) }
                    />
                </PanelBody>
                
                 <PanelBody>
                    <TextControl
                        label={ __( 'When', 'jsforwpblocks' ) }
                        help={ __( 'When', 'jsforwpblocks' ) }
                        value={ when }
                        onChange={ when => setAttributes( { when } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Button Title', 'jsforwpblocks' ) }
                        help={ __( 'Button Title', 'jsforwpblocks' ) }
                        value={ btnTitle }
                        onChange={ btnTitle => setAttributes( { btnTitle } ) }
                    />
                </PanelBody>
                
                 <PanelBody>
                    <TextControl
                        label={ __( 'Button Link', 'jsforwpblocks' ) }
                        help={ __( 'Button Link', 'jsforwpblocks' ) }
                        value={ btnLink }
                        onChange={ btnLink => setAttributes( { btnLink } ) }
                    />
                </PanelBody>
               

            </InspectorControls>
        );
    }
}
