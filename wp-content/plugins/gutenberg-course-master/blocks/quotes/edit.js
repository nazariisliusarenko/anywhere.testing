/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;

const {
    TextControl,
    SelectControl
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
        this.renderContent = this.renderContent.bind(this);
        this.state = { items: [], catName:'' }
        
        
    }
    
    componentWillMount() {
        const {
            attributes: { selectControl, options },
            className, setAttributes  } = this.props;
            this.getContentData({selectControl});
    }
    componentWillReceiveProps(nextProps) {
        const {
            attributes: { selectControl, options },
            className, setAttributes  } = nextProps;
            // condition to fetch data in case state of select did change.
            if(this.props.attributes.selectControl!=nextProps.attributes.selectControl) {
                this.getContentData({selectControl});
                this.getCategoryTitle({selectControl});
            }
    }
    
    getCategoryTitle(catid) {

         apiFetch( { path: '/wp-json/wp/v2/categories/'+catid.selectControl } ).then( posts => {
    
    this.setState({
            catName: posts.name.toString()
        });
        
   
    } );
    }
    getContentData(catid){

    apiFetch( { path: '/wp-json/wp/v2/posts/?categories='+catid.selectControl+'&_embed' } ).then( posts => {
    
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
            <div class="item">
              <div class="row main align-items-center">
                <div class="col-md-6 clip-right">
                  <h2>"{ReactHtmlParser(this.state.items[i].content)}"</h2>
                  <p>{ReactHtmlParser(this.state.items[i].title)}</p>
                  </div>
                  <div class="col-md-6 image-element align-self-stretch">
                      <div class="img-wrap">
                          <img src={this.state.items[i].image} />
                      </div>
                  </div>
              </div>
          </div>
            );
        }
        return items;
    }
}

renderIndicators() {
  if(this.state.items.length>0) {
        var items = [];
        for(var i=0;i<this.state.items.length;i++) {
            items.push(
            <li data-target="#myCarousel" data-slide-to="{i}"></li>
            );
        }
        return items;
    }
}

    render() {
        const {
            attributes: { selectControl },
            className, setAttributes  } = this.props;
            
 
            
        return (
<section class="fairly-quotes">
        <div class="container-fluid">
            

    

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
    
        
        <div class="carousel-inner">
        
        <h1>Load on front end only</h1>     

        </div>

                    
                    
                        
        <ol class="carousel-indicators">
          { this.renderIndicators() }
        </ol>
                    
    
      </div></div>
      </section>
        );
    }
}
