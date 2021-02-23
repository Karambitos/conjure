<?php

namespace RST\Gutenberg;

use RST\Gutenberg\Guten\BlockInterface;

class GutenBlock implements BlockInterface
{

    private $block;
    private $attributes;

    private $render;

    public function __construct() {}

    public function loadFromOptions($options = [])
    {
        $this->block = $options['block'] ?? '';
        $this->attributes = $options['attributes'] ?? [];
        $this->render = $options['render'] ?? false;
    }

    public function isValid()
    {
        return true;
    }

    public function wpInit()
    {
        $blockUrlBase   = apply_filters('gutenblock_base', get_stylesheet_directory_uri() . '/blocks/');
        $blockHandle    = apply_filters('gutenblock_handle', 'rst-block-' . $this->block, $this->block);
        $blockName      = apply_filters('gutenblock_name', 'rst/' . $this->block);

        $blockRegistrationAttr = array(
            'editor_script' => 'rst-gutenberg-blocks',
            'attributes' => $this->attributes
        );

        if($this->render) {
            $blockRegistrationAttr['render_callback'] = $this->render;
        }

        register_block_type( $blockName, $blockRegistrationAttr );
    }

    public static function getTemplatePart($slug, $name = null)
    {
        ob_start();
        get_template_part($slug, $name);
        return ob_get_clean();
    }

}
