<?php

namespace Eheuje\MappingBundle\Mappers;

/**
 * Class BaseMapper
 *
 * @package Eheuje\MappingBundle\Mappers
 * @author  Jean-Yves Camier <jycamier@clever-age.com>
 */
class BaseMapper implements MapperInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $mapping;

    /**
     * BaseMapper constructor.
     *
     * @param string $name
     * @param array  $configs
     */
    public function __construct($name, array $configs)
    {
        $this->name = $name;
        $this->mapping = $configs['mapping'];
    }

    /**
     * @param string $key
     *
     * @return null
     */
    public function getValue($key)
    {
        if (array_key_exists($key, $this->mapping)) {
            return $this->mapping[$key];
        }

        return null;
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function getKey($value)
    {
        if (in_array($value, $this->mapping, true)) {
            return array_search($value, $this->mapping, true);
        }

        return null;
    }

    /**
     * @return array
     */
    public function getMapping()
    {
        return $this->mapping;
    }
}
