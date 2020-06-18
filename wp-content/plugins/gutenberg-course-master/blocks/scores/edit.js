/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    col1Title, col1Text, col2Title, col2Text, col3Title, col3Text, col4Title, col4Text
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const {
            attributes: { col1Title, col1Text, col2Title, col2Text, col3Title, col3Text, col4Title, col4Text },
            className, setAttributes  } = this.props;

        return (
            <div className={ className }>


                <section class="scores">
          <div class="row">
            <div class="col-md-3">
              
              <div class="box-content">
                <div class="line-seperator"></div>
              <h2>{ col1Title }</h2>
               <p>{ col1Text }</p>
              </div>
            
            </div>
            <div class="col-md-3">
              
              <div class="box-content">
                  <div class="line-seperator"></div>
              <h2>{ col2Title }</h2>
               <p>{ col2Text }</p>
              </div>
              
            </div>
            <div class="col-md-3">
                <div class="line-seperator"></div>
              <div class="box-content">
              <h2>{ col3Title }</h2>
               <p>{ col3Text }</p>
              </div>
              
              
            </div>
            <div class="col-md-3">
            
            <div class="box-content">
                <div class="line-seperator"></div>
              <h2>{ col4Title }</h2>
               <p>{ col4Text }</p>
             </div>
              
            </div>
          </div>
        </section>

            </div>
        );
    }
}
