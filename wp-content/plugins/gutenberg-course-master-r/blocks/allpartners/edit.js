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
            this.getContentData({selectControl});
            this.getCategoryTitle({selectControl});
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
            <div class="col-md-12 col-lg-4">
            <div class="whitebox"> 
            <img src={this.state.items[i].image} />
            <h3>{ReactHtmlParser(this.state.items[i].title)}</h3>
            <p>{ReactHtmlParser(this.state.items[i].content)}</p>
            </div> 
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
            <h1>Will render on the front end</h1>
        );
    }
}
