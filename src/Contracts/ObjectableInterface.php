<?php

namespace FifyIO\Googlmapper\Contracts;

interface ObjectableInterface
{
    /**
     * Public constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = []);
}
