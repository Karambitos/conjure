<?php

namespace RST\Gutenberg\Guten;

use RST\Gutenberg\GutenBlock;
use RST\Base\Singleton;

use Exception;

/**
 * Class Guten
 * @package RST\Gutenberg\Guten
 * @method static Guten getInstance()
 */
final class Guten extends Singleton
{

    private $blocks = [];
    private $dependencies = [];

    public function __construct()
    {
        parent::__construct();

        add_action('init', [$this, 'initBlocks']);
        add_action('init', [$this, 'enqueueStyle']);

        add_action('admin_enqueue_scripts', [$this, 'enqueueStyle']);
        add_action('init', [$this, 'enqueueScript']);
    }

    /**
     * Blocks init function
     * @return bool
     */
    public function initBlocks()
    {
        $blocksToLoad = apply_filters('rst_blocks_to_init', $this->blocks);

        foreach ($blocksToLoad as $block) {
            /** @var BlockInterface $block */
            $block->wpInit();
        }

        return true;
    }

    /**
     * Block registration hook
     * @param array $options
     * @return $this
     * @throws Exception if block isn't implement BlockInterface
     */
    public function register($options = [])
    {
        $newBlock = new GutenBlock();

        if (!empty($options['handler'])) {
            if ($options['handler'] instanceof BlockInterface) {
                $newBlock = $options['handler'];
            } else {
                throw new Exception('Block handler should implement RST\Gutenberg\Guten\BlockInterface', 900);
            }
        }

        $newBlock->loadFromOptions($options);

        if ($newBlock->isValid()) {
            $this->blocks[] = $newBlock;
        }

        return $this;
    }

    /**
     * Dependencies setter
     *
     * @param array $deps Dependencies
     * @return Guten $this Instance
     */
    public function setDependencies(array $deps)
    {
        $this->dependencies = array_merge($this->dependencies, $deps);
        return $this;
    }

    /**
     * Enqueue script action
     */
    public function enqueueScript()
    {
        wp_register_script(
            'rst-gutenberg-blocks',
            get_template_directory_uri() . '/assets/dist/blocks.min.js',
            $this->dependencies,
            false, false
        );
    }

    /**
     * Enqueue styles action
     */
    public function enqueueStyle()
    {
        wp_enqueue_style(
            'rst-gutenberg-blocks',
            get_template_directory_uri() . '/assets/dist/blocks.min.css'
        );
    }

}
