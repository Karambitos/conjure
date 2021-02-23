<?php

namespace RST\Base\Rest;

use RST\Base\Singleton;
use Exception;
use Throwable;

/**
 * Custom REST API core class
 *
 * @author Serhii Khomenko <khomenko.mail@gmail.com>
 * @package RST\Base\Rest;
 * @method static Rest getInstance()
 * @var Rest $instance
 */
class Rest extends Singleton
{

    /** @var array $resources List of custom api resources */
    private $resources;

    /** @var string $namespace REST API namespace  */
    private $namespace;

    protected function __construct()
    {
        parent::__construct();

        add_action('rest_api_init', [$this, 'resourceInit']);
    }

    /**
     * Add custom REST resource
     * @param ResourceInterface $resource resource (should implement ResourceInterface)
     */
    public function addResource(ResourceInterface $resource)
    {
        $this->resources[] = $resource;
    }

    /**
     * Rest namespace setter
     * @param string $ns Namespace
     */
    public function setNamespace(string $ns)
    {
        $this->namespace = $ns;
    }

    /**
     * Register recourse route function
     *
     * @param ResourceInterface $resource Resource to register
     * @throws Exception Exception if namespace wasn't set up
     */
    private function registerRoutes(ResourceInterface $resource)
    {
        if(empty($this->namespace)) {
            throw new Exception('Can\'t register any route without namespace', 901);
        }

        foreach ($resource->getRoutes() as $route => $args) {
            register_rest_route($this->namespace, $resource->getResourceName() . $route, $args);
        }
    }

    public function resourceInit()
    {
        foreach($this->resources as $res) {
            /** @var ResourceInterface $res */
            try {
                $this->registerRoutes($res);
            } catch (Throwable $exception) {
                error_log($exception->getMessage());
            }
        }
    }

}
