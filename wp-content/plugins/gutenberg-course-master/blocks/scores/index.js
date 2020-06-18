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
    'jsforwpblocks/scores',
    {
        title: __('StepConference - Scores', 'jsforwpblocks'),
        description: __('Stepconference Scores.', 'jsforwpblocks'),
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

            return (
                <section class="scores">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box-content">
                <div class="line-seperator"></div>
              <h2>{ attributes.col1Title }</h2>
               <p>{ attributes.col1Text }</p>
              </div>
            
            </div>
            <div class="col-md-3">
              
              <div class="box-content">
                  <div class="line-seperator"></div>
              <h2>{ attributes.col2Title }</h2>
               <p>{ attributes.col2Text }</p>
              </div>
              
            </div>
            <div class="col-md-3">
                <div class="line-seperator"></div>
              <div class="box-content">
              <h2>{ attributes.col3Title }</h2>
               <p>{ attributes.col3Text }</p>
              </div>
              
              
            </div>
            <div class="col-md-3">
            
            <div class="box-content">
                <div class="line-seperator"></div>
              <h2>{ attributes.col4Title }</h2>
               <p>{ attributes.col4Text }</p>
             </div>
              
            </div>
          </div>
        </section>
            );
        },
    },
);
