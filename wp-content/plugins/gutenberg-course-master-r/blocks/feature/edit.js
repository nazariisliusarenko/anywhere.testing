/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    Editable,
    MediaUpload,
} = wp.editor;
const {
    CheckboxControl,
    RadioControl,
    RangeControl,
    TextControl,
    TextareaControl,
    ToggleControl,
    Button,
    SelectControl
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
        this.state = { output : '' }
        this.renderLeftToRight = this.renderLeftToRight.bind(this);
    }
    
    componentWillMount() {
         const {
            attributes: { checkboxControl, colorPaletteControl, radioControl, rangeControl, textControl, textareaControl, toggleControl, selectControl },
            className, setAttributes  } = this.props;
             if(this.props.attributes.imagePosition == "leftToRight"){
                 this.setState = {
                    output: this.renderLeftToRight()
                }
             }
             if(this.props.attributes.imagePosition == "rightToLeft"){

             }
    }
    componentWillReceiveProps(nextProps) {
        const {
            attributes: { checkboxControl, colorPaletteControl, radioControl, rangeControl, textControl, textareaControl, toggleControl, selectControl },
            className, setAttributes  } = nextProps;
            if(nextProps.attributes.imagePosition == "leftToRight") {
                this.setState = {
                    output: this.renderLeftToRight()
                }
            }
            if(nextProps.attributes.imagePosition == "rightToLeft") {

            }
    }
    renderLeftToRight() {
        const { attributes: { imgID, imgURL, imgAlt },
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
        return (
            <section class="features1">
            
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-6 image-element align-self-stretch">
                            <div class="img-wrap">
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
                                    
                                    { __( ' Upload Image', 'jsforwpblocks' ) }
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


                            </div>
                        </div>
                        <div class="col-md-6 text-element">
                                <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                    {this.props.attributes.heading}
                                </h2>
                                    <p>{this.props.attributes.textareaDescription}</p>
            
                                <div class="align-center">
                                    <a class="btn btn-md-2" href={this.props.attributes.btnLink}>{this.props.attributes.btnName}</a>
                                </div>
            
                        </div>
                      
                    </div>
                </div>          
            </section>
        );
    }
    renderRightToLeft() {
        const { attributes: { imgID, imgURL, imgAlt },
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
        return (
            <section class="features2">
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                  {this.props.attributes.heading}
                                </h2>
                                    <p>{this.props.attributes.textareaDescription}</p>
                                
             <div class="align-center">
                                    <a class="btn btn-md-2 btn-primary" href={this.props.attributes.btnLink}>{this.props.attributes.btnName}</a>
                                </div>
            
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
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
                                    
                                    { __( ' Upload Image', 'jsforwpblocks' ) }
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


                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>          
            </section>
        );
    }
    renderLightLeftToRight() {
        const { attributes: { imgID, imgURL, imgAlt },
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
        return (
            <section class="features3">
            
                 <div class="container-fluid">
                        <div class="row main align-items-center">
                            <div class="col-md-6 image-element align-self-stretch">
                                 <div class="img-wrap">
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
                                    
                                    { __( ' Upload Image', 'jsforwpblocks' ) }
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


                            </div>
                            </div>
                            <div class="col-md-6 text-element">
                                    <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                        {this.props.attributes.heading}
                                    </h2>
                                        <p>
                                            {this.props.attributes.textareaDescription}
                                        </p>
                
                                    <div class="align-center">
                                        <a class="btn btn-md-1" href={this.props.attributes.btnLink}>{this.props.attributes.btnName}</a>
                                    </div>
                
                            </div>
                          
                        </div>
                    </div>    
                    
            </section>
        );
    }
    renderLightRightToLeft() {
        const { attributes: { imgID, imgURL, imgAlt },
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
        return (
            <section class="features3">
            <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                  {this.props.attributes.heading}
                                </h2>
                                    <p>{this.props.attributes.textareaDescription}</p>
                                
             <div class="align-center">
                                    <a class="btn btn-md-1" href={this.props.attributes.btnLink}>{this.props.attributes.btnName}</a>
                                </div>
            
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
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
                                    
                                    { __( ' Upload Image', 'jsforwpblocks' ) }
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


                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>    
               
            </section>
        );
    }
    render() {
        const {
            className, setAttributes  } = this.props;
            
            if(this.props.attributes.imagePosition=="leftToRight" && this.props.attributes.backgroundColor=="lightBlue") {
                return (
                    <div className={ className }>
        
                        {this.renderLightLeftToRight()}
        
                    </div>
                );
            }
            if(this.props.attributes.imagePosition=="rightToLeft" && this.props.attributes.backgroundColor=="lightBlue") {
                return (
                    <div className={ className }>
        
                        {this.renderLightRightToLeft()}
        
                    </div>
                );
            }
            if(this.props.attributes.imagePosition=="rightToLeft" && this.props.attributes.backgroundColor=="darkBlue") {
                return (
                    <div className={ className }>
        
                        {this.renderRightToLeft()}
        
                    </div>
                );
            }
            return (
                    <div className={ className }>
        
                        {this.renderLeftToRight()}
        
                    </div>
                );
            
        
    }
}
