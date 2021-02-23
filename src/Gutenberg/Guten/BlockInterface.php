<?php

namespace RST\Gutenberg\Guten;


interface BlockInterface
{

    public function isValid();
    public function loadFromOptions();
    public function wpInit();

}
