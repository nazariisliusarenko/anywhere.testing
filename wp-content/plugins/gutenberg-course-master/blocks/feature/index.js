/**
 * Block dependencies
 */
import classnames from 'classnames';
import Inspector from './inspector';
import Edit from './edit';
import icon from './icon';
import attributes from './attributes';
import './style.scss';

const { __ } = wp.i18n;
const {
    registerBlockType,
} = wp.blocks;
const {
    RichText,
    Editable,
    MediaUpload,
} = wp.editor;
const {
    Button,
} = wp.components;


/**
 * Register static block example block
 */
export default registerBlockType(
    'jsforwpblocks/feature',
    {
        title: __('StepConference - Feature', 'jsforwpblocks'),
        description: __('An example of how to use StepConference Feature.', 'jsforwpblocks'),
        category: 'widgets',
        icon: {
            background: 'rgba(254, 243, 224, 0.52)',
            src: icon,
        },
        keywords: [
            __('Palette', 'jsforwpblocks'),
            __('Settings', 'jsforwpblocks'),
            __('Scheme', 'jsforwpblocks'),
        ],
        attributes,
        getEditWrapperProps(attributes) {
            
        },
        edit: props => {
            const { setAttributes } = props;

            return [
                <Inspector {...{ setAttributes, ...props }} />,
                <Edit {...{ setAttributes, ...props }} />
            ];
        },
        save: props => {
            
            const { attributes, className, setAttributes, isSelected } = props;
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
                        var renderImg;
if (attributes.youtubeLink) {
  renderImg = <iframe width="100%" height="380"
src={attributes.youtubeLink + '?controls=0' }>
</iframe>;
} else {
  renderImg=  <img
                                src={ attributes.imgURL }
                                alt={ attributes.imgAlt }
                            />;
}
attributes.imgSrc = attributes.imgURL;
attributes.imagePosition = attributes.imagePosition;
attributes.bgColor = attributes.backgroundColor;
var renderBtn1;
var renderBtn2;
if(attributes.btnLink) {
        renderBtn1  =<div class="align-center">
                                    <a class="btn btn-md-1" href={attributes.btnLink}>{attributes.btnName}</a>
                                </div>
        renderBtn2 = <div class="align-center">
                                    <a class="btn btn-md-2" href={attributes.btnLink}>{attributes.btnName}</a>
                                </div>
}

           if(attributes.imagePosition=="leftToRight" && attributes.backgroundColor=="lightBlue") {
                return (
                   <section class="features3">
            
                 <div class="container-fluid">
                        <div class="row main align-items-center">
                            <div class="col-md-6 image-element align-self-stretch">
                                 <div class="img-wrap">
                         {renderImg}

                            </div>
                            </div>
                            <div class="col-md-6 text-element">
                                    <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                        {attributes.heading}
                                    </h2>
                                        <p>
                                            {attributes.textareaDescription}
                                        </p>
                
                                   {renderBtn1}
                
                            </div>
                          
                        </div>
                    </div>    
                    
            </section>
                );
            }
            if(attributes.imagePosition=="rightToLeft" && attributes.backgroundColor=="lightBlue") {
                return (
                    <section class="features3">
            <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                  {attributes.heading}
                                </h2>
                                    <p>{attributes.textareaDescription}</p>
                                
                                
                                {renderBtn1}
            
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
                          {renderImg}


                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>    
               
            </section>
                );
            }
            if(attributes.imagePosition=="rightToLeft") {
                return (
                   <section class="features2">
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                  {attributes.heading}
                                </h2>
                                    <p>{attributes.textareaDescription}</p>
                                
                       {renderBtn2}
            
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
                           {renderImg}


                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>          
            </section>
                );
            }
            return (
            <section class="features1">
            
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-6 image-element align-self-stretch">
                            <div class="img-wrap">

                           {renderImg}


                            </div>
                        </div>
                        <div class="col-md-6 text-element">
                                <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                    {attributes.heading}
                                </h2>
                                    <p>{attributes.textareaDescription}</p>
            
                                {renderBtn2}
            
                        </div>
                      
                    </div>
                </div>          
            </section>
                );
        },
    },
);
