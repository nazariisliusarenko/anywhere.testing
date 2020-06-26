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
} = wp.editor;
const { Spinner } = wp.components;
const { withSelect } = wp.data;
/**
 * Register static block example block
 */
export default registerBlockType(
    'jsforwpblocks/quotes',
    {
        title: __('StepConference - Quotes', 'jsforwpblocks'),
        description: __('An example of how to use StepConference Quotes.', 'jsforwpblocks'),
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
            const { attributes } = props;

            return (

<section class="fairly-quotes"><div class="container-fluid"><div id="myCarousel" class="carousel slide" data-ride="carousel"><div class="carousel-inner"><div class="item active"><div class="row main align-items-center"><div class="col-md-6 clip-right"><h2>"This is supposed to be replaced with a fairly short code"</h2><p>Name Lastname</p></div><div class="col-md-6 image-element align-self-stretch"><div class="img-wrap"><img src="https://mobirise.com/html-templates/premium/assets/images/02.jpg" media-simple="true"/></div></div></div></div><div class="item"><div class="row main align-items-center"><div class="col-md-6 clip-right"><h2>"This is supposed to be replaced with a fairly short code"</h2><p>Name Lastname</p></div><div class="col-md-6 image-element align-self-stretch"><div class="img-wrap"><img src="https://mobirise.com/html-templates/premium/assets/images/02.jpg" media-simple="true"/></div></div></div></div><div class="item"><div class="row main align-items-center"><div class="col-md-6 clip-right"><h2>"This is supposed to be replaced with a fairly short code"</h2><p>Name Lastname</p></div><div class="col-md-6 image-element align-self-stretch"><div class="img-wrap"><img src="https://mobirise.com/html-templates/premium/assets/images/02.jpg" media-simple="true"/></div></div></div></div></div><ol class="carousel-indicators"><li data-target="#myCarousel" data-slide-to="0" class="active"></li><li data-target="#myCarousel" data-slide-to="1"></li><li data-target="#myCarousel" data-slide-to="2"></li></ol></div></div></section>

);
        },
    },
);
