<?php

namespace RST\Base\Structure;

/**
 * Taxonomy builder class
 * @package RST\Base\Structure
 */
final class Taxonomy
{

    /** @var array $postTypes Post types for taxonomy */
    private $postTypes;

    /** @var string $taxonomy Taxonomy name */
    private $taxonomy;

    /** @var string $slug Taxonomy permalink slug */
    private $slug;

    /** @var array $labels Post type labels */
    private $labels;

    /** @var array $args Post type arguments */
    private $args;

    public function __construct(string $taxonomy, $slug = '')
    {
        add_action('init', [$this, 'registerTaxonomy']);

        // Default argument values
        $this->args = [
            'label'                 => '',
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => null,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_tagcloud'         => true,
            'show_in_rest'          => null,
            'rest_base'             => null,
            'hierarchical'          => true,
            'update_count_callback' => '',
            'capabilities'          => [],
            'meta_box_cb'           => null,
            'show_admin_column'     => false,
            '_builtin'              => false,
            'show_in_quick_edit'    => null,
        ];

        $this->taxonomy = $taxonomy;
        $this->slug = $slug;
    }

    public function registerTaxonomy()
    {
        if (empty($this->postTypes)) {
            return false;
        }

        if (empty($this->slug)) {
            $this->args['rewrite'] = false;
        } else {
            $this->args['rewrite'] = ['slug' => $this->slug, 'with_front' => false];
        }

        $this->args['labels'] = $this->labels;
        $postTypesList = [];
        foreach ($this->postTypes as $postType) {
            /** @var PostType $postType */
            $postTypesList[] = $postType->getPostType();
        }

        register_taxonomy($this->taxonomy, $postTypesList, $this->args);
        return true;
    }

    /**
     * Taxonomy slug setter
     * @param string $slug Taxonomy slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Taxonomy labels setter
     * @param array $labels Taxonomy labels list
     */
    public function setLabels(array $labels)
    {
        $this->labels = $labels;
    }

    /**
     * Taxonomy arguments setter
     * @param array $args Arguments list
     */
    public function setArgs(array $args)
    {
        $this->args = array_merge($this->args, $args);
    }

    /**
     * Set post type as used by taxonomy
     * @param PostType $postType Post type instance
     */
    public function uses(PostType $postType)
    {
        $this->postTypes[] = $postType;
    }


}
