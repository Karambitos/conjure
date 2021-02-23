const { RichText, PlainText, InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

registerBlockType('rst/post-snapshot', {
    title: 'Post Snapshot',

    category: 'common',

    attributes: {
        selectedPost: {
            type: 'string'
        }
    },

    edit: withSelect( select => {
        return { posts: select( 'core' ).getEntityRecords( 'postType', 'post' ) };
    })(props => {

        let apiPosts = props.posts,
            className = props.className,
            selected = props.attributes.selectedPost;

        return <select className={className} value={ props.attributes.selectedPost }
        onChange={ event => { props.setAttributes({selectedPost: event.target.value}) } }>
    <option value="0">Select a post</option>
        {apiPosts && apiPosts.map( post => {
            return <option value={ post.id } selected={ selected && post.id === selected } >{ post.title.rendered }</option>
        })}
    </select>;
    }),

    save(){
        return null;
    }

});
