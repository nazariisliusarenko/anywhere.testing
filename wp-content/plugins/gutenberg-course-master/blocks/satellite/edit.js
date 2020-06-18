/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    ColorPalette,
    Editable,
    MediaUpload,
} = wp.editor;
const {
    Button,
    SelectControl,
    imgID, imgURL, imgAlt , imgID2, imgURL2, imgAlt2 , bgimg, logoimg, heading, content, where, when, btnTitle, btnLink
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
      const { attributes: { imgID, imgURL, imgAlt , imgID2, imgURL2, imgAlt2 , bgimg, logoimg, heading, content, where, when, btnTitle, btnLink},
                className, setAttributes, isSelected } = this.props;
            const onSelectImage = img => {
                setAttributes( {
                    imgID: img.id,
                    imgURL: img.url,
                    imgAlt: img.alt,
                } );
            };
            const onRemoveImage = () => {
                setAttributes({
                    imgID: null,
                    imgURL: null,
                    imgAlt: null,
                });
            }
            
            const onSelectImage2 = img2 => {
                setAttributes( {
                    imgID2: img2.id,
                    imgURL2: img2.url,
                    imgAlt2: img2.alt,
                } );
            };
            const onRemoveImage2 = () => {
                setAttributes({
                    imgID2: null,
                    imgURL2: null,
                    imgAlt2: null,
                });
            }

var renderbtn = '';
if (btnLink) {
    var renderbtn = <div class="action-buttons">
              <a href={ btnLink }><button type="button" class="btn" >{btnTitle}</button></a>
      </div>
}
        return (
             <section class="satelitte">
  <div class="bgimg">
    { ! imgID ? (

                        <MediaUpload
                            onSelect={ onSelectImage }
                            type="image"
                            value={ imgID }
                            render={ ( { open } ) => (
                                <Button
                                    className={ "button button-large" }
                                    onClick={ open }
                                >
                                    
                                    { __( ' Upload Background Image', 'jsforwpblocks' ) }
                                </Button>
                            ) }
                        >
                        </MediaUpload>

                    ) : (

                        <p class="image-wrapper">
                            <img
                                src={ imgURL }
                                alt={ imgAlt }
                            />

                            { isSelected ? (

                                <Button
                                    className="remove-image"
                                    onClick={ onRemoveImage }
                                >
                                   { __( ' Remove Image', 'jsforwpblocks' ) }
                                </Button>

                            ) : null }

                        </p>
                    )}
    <div class="eventlogo">
      
      { ! imgID2 ? (

                        <MediaUpload
                            onSelect={ onSelectImage2 }
                            type="image"
                            value={ imgID2 }
                            render={ ( { open } ) => (
                                <Button
                                    className={ "button button-large" }
                                    onClick={ open }
                                >
                                    
                                    { __( ' Upload Logo Image', 'jsforwpblocks' ) }
                                </Button>
                            ) }
                        >
                        </MediaUpload>

                    ) : (

                        <p class="image-wrapper">
                            <img
                                src={ imgURL2 }
                                alt={ imgAlt2 }
                            />

                            { isSelected ? (

                                <Button
                                    className="remove-image"
                                    onClick={ onRemoveImage2 }
                                >
                                   { __( ' Remove Image', 'jsforwpblocks' ) }
                                </Button>

                            ) : null }

                        </p>
                    )}
      
    </div>
  </div>
    <div class="container">
  <div class="row">
    <div class="col-md-12">
  <h2>{ heading }</h2>
  <p>{ content }</p>
    </div>
      </div>
    <div class="row">
      <div class="col-md-4">Where<br/>
      { where }
      </div>
    <div class="col-md-4">When<br/>
    { when } 
    </div>
      <div class="col-md-4">
      { renderbtn }
      </div>
  </div>
  </div>
</section>
        );
    }
}
