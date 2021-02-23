<?php

namespace RST\Base\Rest;

interface ResourceInterface
{

    public function getRoutes() : array;
    public function getResourceName() : string;

}
