const { PlainText } = wp.editor;
const { registerBlockType } = wp.blocks;

import './admin.scss';

registerBlockType('rst/example-block', {
    title: 'Example block',

    category: 'common',

    attributes: {
        title: {
            type: 'string'
        }
    },

    edit({ attributes, className, setAttributes }) {
        return (
            <PlainText
                onChange={ content => setAttributes({ title: content }) }
                value={ attributes.title }
                placeholder="Text block heading here"
                className="heading"
            />
        );
    },

    save({ attributes }) {
        return (
            <div className='example-block'>
                { attributes.title }
            </div>
        );
    }

});
