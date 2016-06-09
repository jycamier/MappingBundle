<?php

namespace Eheuje\MappingBundle\Mappers;

/**
 * Interface MapperInterface
 *
 * @package Eheuje\MappingBundle\Mappers
 */
interface MapperInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getValue($key);

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function getKey($value);

    /**
     * @return mixed
     */
    public function getMapping();
}
