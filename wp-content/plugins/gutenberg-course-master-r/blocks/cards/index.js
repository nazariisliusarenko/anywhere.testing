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
    'jsforwpblocks/cards',
    {
        title: __('StepConference - Cards', 'jsforwpblocks'),
        description: __('SteoConference - Cards', 'jsforwpblocks'),
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

            return (
               <section class="what-you-get">
    <div class="row">
      <div class="col-md-12 align-center">
        <h2>{attributes.heading}</h2>
        <p class="sub">{attributes.heading}</p>
      </div>
    </div>
    <div class="row">
     { attributes.heading }
    </div>
  </section>
            );
        },
    },
);
