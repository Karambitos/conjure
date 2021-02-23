<?php

namespace RST\Rest\Resources;

use RST\Base\Rest\ResourceInterface;

/**
 * Example rest resource class
 * @package RST\Rest\Resources
 */
class TestData implements ResourceInterface
{
    public function getRoutes(): array
    {
        return [
            '/' => [
                'methods'  => 'GET',
                'callback' => [ __CLASS__, 'testRoute' ]
            ]
        ];
    }

    public function getResourceName(): string
    {
        return 'test_data';
    }

    public static function testRoute()
    {
        return ['test' => 'data'];
    }
}
