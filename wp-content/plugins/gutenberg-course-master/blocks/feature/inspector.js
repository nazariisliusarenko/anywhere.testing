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
    RadioControl,
    TextControl,
    TextareaControl,
    imagePosition, backgroundColor, heading, textareaDescription, btnName, btnLink, youtubeLink
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const { attributes: { imagePosition, backgroundColor, heading, textareaDescription, btnName, btnLink, youtubeLink
        }, setAttributes } = this.props;

        return (
            <InspectorControls>

               

                <PanelBody>
                    <RadioControl
                        label={ __( 'Image Position', 'jsforwpblocks' ) }
                        selected={ imagePosition }
                        options={ [
                            { label: 'Left To Right', value: 'leftToRight' },
                            { label: 'Right To Left', value: 'rightToLeft' },
                        ] }
                        onChange={ imagePosition => setAttributes( { imagePosition } ) }
                    />
                </PanelBody>
                <PanelBody>
                    <RadioControl
                        label={ __( 'Background Color', 'jsforwpblocks' ) }
                        selected={ backgroundColor }
                        options={ [
                            { label: 'Dark Blue', value: 'darkBlue' },
                            { label: 'Light Blue', value: 'lightBlue' },
                        ] }
                        onChange={ backgroundColor => setAttributes( { backgroundColor } ) }
                    />
                </PanelBody>

                <PanelBody>
                    <TextControl
                        label={ __( 'Heading Title', 'jsforwpblocks' ) }
                        help={ __( 'Heading Title', 'jsforwpblocks' ) }
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


                 <PanelBody>
                    <TextControl
                        label={ __( 'Button Name', 'jsforwpblocks' ) }
                        help={ __( 'Button Name', 'jsforwpblocks' ) }
                        value={ btnName }
                        onChange={ btnName => setAttributes( { btnName } ) }
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
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Youtube Link', 'jsforwpblocks' ) }
                        help={ __( 'Youtube Link', 'jsforwpblocks' ) }
                        value={ youtubeLink }
                        onChange={ youtubeLink => setAttributes( { youtubeLink } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
