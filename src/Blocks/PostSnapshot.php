<?php

namespace RST\Blocks;

use RST\Gutenberg\GutenBlock;

class PostSnapshot extends GutenBlock
{

    public static function renderCallback($attributes)
    {
        set_query_var('post_snapshot_attributes', $attributes);
        return self::getTemplatePart('blocks/post-snapshot/render');
    }

}
