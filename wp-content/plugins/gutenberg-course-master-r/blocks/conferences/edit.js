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
            }
    }
    

    

    getContentData(catid){

    apiFetch( { path: '/wp-json/wp/v2/posts/?categories='+catid.selectControl+'&_embed' } ).then( posts => {
    
    var items = [];
    var item;
    
    for(var i = 0; i<posts.length;i++) {
        item = { id: posts[i].id.toString() , title: posts[i].title.rendered.toString(), content: posts[i].excerpt.rendered.toString(), image: posts[i]._embedded['wp:featuredmedia']['0'].source_url };
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
            <li><div class="logo"><a href={this.state.items[i].content}><img src={this.state.items[i].image} /></a></div></li>
            );
        }
        return items;
    }
}

    render() {
        const {
            attributes: { selectControl, heading, subheading },
            className, setAttributes  } = this.props;
            
 
            
        return (
            <div className={ className }>

<section class="conference">
        <div class="row">
          <div class="col-md-12">
            <h2>{this.props.attributes.heading}</h2>
            <p>{this.props.attributes.subheading}</p>
            
            <ul class="logos">
            {this.renderContent()}
            </ul>
          </div>
        </div>
        </section>

            </div>
        );
    }
}
