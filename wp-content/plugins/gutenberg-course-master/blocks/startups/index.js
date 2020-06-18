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
    'jsforwpblocks/startups',
    {
        title: __('StepConference - Startups', 'jsforwpblocks'),
        description: __('An example of how to use StepConference Startups.', 'jsforwpblocks'),
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
                <section class="partners dark">
                  <h2>{attributes.heading}</h2>
                  <p class="sub">{attributes.heading}</p>
                  <div class="container">
                    <div class="double-border skewed">
                      <div class="content">
                        <div class="row listing">
                          {attributes.heading}
                        </div>
                      </div>
                    </div>
                  </div>
              </section>
            );
        },
    },
);
