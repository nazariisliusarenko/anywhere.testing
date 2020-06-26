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
import apiFetch from '@wordpress/api-fetch';
const { Spinner } = wp.components;
const { withSelect } = wp.data;


/**
 * Register static block example block
 */
export default registerBlockType(
    'jsforwpblocks/banners',
    {
        title: __('StepConference - Banners', 'jsforwpblocks'),
        description: __('An example of how to use StepConference Banners.', 'jsforwpblocks'),
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
        }
        , // end edit
    save: props => {
            const { attributes } = props;
            const {videobg } = "mp4: " + attributes.mp4Url + ", webm: " + attributes.webmUrl;
            return (
                     <div class="section hero-section"  data-vide-bg={videobg} data-vide-options="posterType: jpg, loop: true, muted: true">
         <div class="beforeVideo">
           <video autoplay="" loop="" muted="">
             <source src={attributes.mp4Url} type="video/mp4" />
             <source src={attributes.mp4Url} type="video/webm" />
             </video>
             </div>
	<div class="section-contents theme-dark">
		
			<section class="techFestivalForm">
            <h1>{attributes.heading}</h1>
            <p>{attributes.subheading}</p>
          </section>
	</div>
</div>
            );
        },
    },
);
