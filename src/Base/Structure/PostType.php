<?php

namespace RST\Base\Structure;

/**
 * Post type creation class
 * @package RST\Base\Structure
 */
final class PostType
{

    /** @var string $postType Post type name */
    private $postType;

    /** @var array $labels Post type labels */
    private $labels;

    /** @var array $args Post type arguments */
    private $args;

    public function __construct($postType)
    {
        add_action('init', [$this, 'registerPostType']);

        // Default argument values
        $this->args = [
            'label'               => null,
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => null,
            'exclude_from_search' => null,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'show_in_rest'        => true,
            'template'            => [],
            'rest_base'           => $postType,
            'menu_position'       => true,
            'menu_icon'           => 'dashicons-admin-site',
            'hierarchical'        => false,
            'supports'            => ['title', 'editor', 'thumbnail'],
            'taxonomies'          => [],
            'has_archive'         => true,
            'rewrite'             => true,
            'query_var'           => true,
        ];

        $this->postType = $postType;
    }

    /**
     * Register post type function
     */
    public function registerPostType()
    {
        $this->args['labels'] = $this->labels;
        register_post_type($this->postType, $this->args);
    }

    /**
     * Post type getter
     * @return string Post type name
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Labels setter
     *
     * @param array $labels Labels list
     */
    public function setLabels(array $labels)
    {
        $this->labels = $labels;
    }

    /**
     * Post type arguments setter
     *
     * @param array $args Arguments list
     */
    public function setArgs(array $args)
    {
        $this->args = array_merge($this->args, $args);
    }

}
