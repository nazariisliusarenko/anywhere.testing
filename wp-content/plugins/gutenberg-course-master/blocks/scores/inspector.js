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
    PanelRow,
    TextControl,
    col1Title, col1Text, col2Title, col2Text, col3Title, col3Text, col4Title, col4Text
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const { attributes: { col1Title, col1Text, col2Title, col2Text, col3Title, col3Text, col4Title, col4Text }, setAttributes } = this.props;

        return (
            <InspectorControls>
               
                <PanelBody>
                    <TextControl
                        label={ __( 'Col1 Title', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col1Title }
                        onChange={ col1Title => setAttributes( { col1Title } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Col1 Text', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col1Text }
                        onChange={ col1Text => setAttributes( { col1Text } ) }
                    />
                </PanelBody>
                

                <PanelBody>
                    <TextControl
                        label={ __( 'Col2 Title', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col2Title }
                        onChange={ col2Title => setAttributes( { col2Title } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Col2 Text', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col2Text }
                        onChange={ col2Text => setAttributes( { col2Text } ) }
                    />
                </PanelBody>
              <PanelBody>
                    <TextControl
                        label={ __( 'Col3 Title', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col3Title }
                        onChange={ col3Title => setAttributes( { col3Title } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Col3 Text', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col3Text }
                        onChange={ col3Text => setAttributes( { col3Text } ) }
                    />
                </PanelBody>
                
                 <PanelBody>
                    <TextControl
                        label={ __( 'Col4 Title', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col4Title }
                        onChange={ col4Title => setAttributes( { col4Title } ) }
                    />
                </PanelBody>
                
                <PanelBody>
                    <TextControl
                        label={ __( 'Col4 Text', 'jsforwpblocks' ) }
                        help={ __( 'Text control help text', 'jsforwpblocks' ) }
                        value={ col4Text }
                        onChange={ col4Text => setAttributes( { col4Text } ) }
                    />
                </PanelBody>
               

            </InspectorControls>
        );
    }
}
