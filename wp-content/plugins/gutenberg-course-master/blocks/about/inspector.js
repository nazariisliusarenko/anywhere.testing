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
    heading, textareaDescription, whereText, whenText, btnName, btnLink
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const { attributes: { heading, textareaDescription, whereText, whenText, btnName, btnLink  }, setAttributes } = this.props;

        return (
            <InspectorControls>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Heading', 'jsforwpblocks' ) }
                        help={ __( 'Headings', 'jsforwpblocks' ) }
                        value={ heading }
                        onChange={ heading => setAttributes( { heading } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextareaControl
                        label={ __( 'Text Description', 'jsforwpblocks' ) }
                        help={ __( 'Text area control Description', 'jsforwpblocks' ) }
                        value={ textareaDescription }
                        onChange={ textareaDescription => setAttributes( { textareaDescription } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Where', 'jsforwpblocks' ) }
                        help={ __( 'Where', 'jsforwpblocks' ) }
                        value={ whereText }
                        onChange={ whereText => setAttributes( { whereText } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'When', 'jsforwpblocks' ) }
                        help={ __( 'When', 'jsforwpblocks' ) }
                        value={ whenText }
                        onChange={ whenText => setAttributes( { whenText } ) }
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

            </InspectorControls>
        );
    }
}
