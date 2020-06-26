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


/**
 * Register static block example block
 */
export default registerBlockType(
    'jsforwpblocks/satellite',
    {
        title: __('StepConference - Satellite', 'jsforwpblocks'),
        description: __('Stepconference Sattelite.', 'jsforwpblocks'),
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
        edit: props => {
            const { setAttributes } = props;

            return [
                <Inspector {...{ setAttributes, ...props }} />,
                <Edit {...{ setAttributes, ...props }} />
            ];
        },
        save: props => {
            const { attributes } = props;
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
            
            const onSelectImage2 = img => {
                setAttributes( {
                    imgID2: img.id,
                    imgURL2: img.url,
                    imgAlt2: img.alt,
                } );
            };
            const onRemoveImage2 = () => {
                setAttributes({
                    imgID2: null,
                    imgURL2: null,
                    imgAlt2: null,
                });
            }
            
            var bgImg = {
  backgroundImage: 'url(' + attributes.imgURL + ')',
};

var eventlogo = {
    backgroundImage: 'url(' + attributes.imgURL2 + ')',
}

var renderbtn = '';
if (attributes.btnLink) {
    var renderbtn = <div class="action-buttons">
              <a href={ attributes.btnLink }><button type="button" class="btn" >{attributes.btnTitle}</button></a>
      </div>
}


            return (
                <section class="satelitte">
  <div class="bgimg" style={bgImg}>
    <div class="eventlogo" style={eventlogo}>
    &nbsp;
    </div>
  </div>
    <div class="container">
  <div class="row">
    <div class="col-md-12">
  <h2>{attributes.heading}</h2>
  <p>{attributes.content}</p>
    </div>
      </div>
    <div class="row">
      <div class="col-sm-4"><span class="where">Where</span><br/>
      <span class="roboto">{attributes.where}</span>
      </div>
    <div class="col-sm-4"><span class="when">When</span><br/>
    <span class="roboto">{attributes.when}</span> 
    </div>
      <div class="col-sm-4">
      {renderbtn}
      </div>
      
  </div>
  </div>
</section>
            );
        },
    },
);
