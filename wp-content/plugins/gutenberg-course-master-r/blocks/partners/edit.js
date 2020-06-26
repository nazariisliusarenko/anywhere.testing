/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    TextControl,
    SelectControl,
    heading
} = wp.components;
import apiFetch from '@wordpress/api-fetch';
import ReactHtmlParser from 'react-html-parser';
/**
 * Create an Inspector Controls wrapper Component
 */
export default class Edit extends Component {

    constructor() {
        super( ...arguments );
        this.getContentData = this.getContentData.bind(this);
        this.getCategoryTitle = this.getCategoryTitle.bind(this);
        this.renderContent = this.renderContent.bind(this);
        this.state = { items: [], catName:'' }
        
        
    }
    
    componentWillMount() {
        const {
            attributes: { selectControl, options },
            className, setAttributes  } = this.props;
            //this.getContentData({selectControl});
            this.getCategoryTitle({selectControl});
    }
    componentWillReceiveProps(nextProps) {
        const {
            attributes: { selectControl, options },
            className, setAttributes  } = nextProps;
            //this.getContentData({selectControl});
            this.getCategoryTitle({selectControl});
    }
    
    getCategoryTitle(catid) {

         apiFetch( { path: '/wp-json/wp/v2/categories/?per_page=100&'+catid.selectControl } ).then( posts => {
    
    this.setState({
            catName: posts.name.toString()
        });
        
   
    } );
    }
    getContentData(catid){

    apiFetch( { path: '/wp-json/wp/v2/partners/?per_page=100&categories='+catid.selectControl+'&_embed' } ).then( posts => {
    
    var items = [];
    var item;
    
    for(var i = 0; i<posts.length;i++) {
        item = { id: posts[i].id.toString() , title: posts[i].title.rendered.toString(), content: posts[i].content.rendered.toString(), image: posts[i]._embedded['wp:featuredmedia']['0'].source_url };
        items.push(item);
    }
    this.setState({
            items: items
        });
   
    } );
}

renderContent() {
    if(this.state.items.length>0) {
        var items = [];
        for(var i=0;i<this.state.items.length;i++) {
            items.push(
                <div class="col-xs-6 partner-box-wrapper item-width">
                <div class="box">
                <a title="Vision ventures" href="http://visionvc.co" target="_blank" class="lazy-fade partner" data-original="https://conference.stepcdn.com/logos/MO57iSG/rEgA3JuTKCizlVupKV7I_vv-300.png"></a></div>
                </div>
            );
        }
        return items;
    }
}

    render() {
        const {
            attributes: { selectControl, heading },
            className, setAttributes  } = this.props;
            
 
            
        return (
            <div className={ className }>
            
            <section class="partners dark">
                  <h2>{this.state.catName}</h2>
                  <p class="sub">{heading}</p>
                  <div class="container">
                    <div class="double-border skewed">
                      <div class="content">
                        <div class="row listing">

                        </div>
                      </div>
                    </div>
                  </div>
              </section>


            </div>
        );
    }
}
