<?php

namespace OsrmClient\Element;

class ParameterBag implements \ArrayAccess
{
    protected $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->parameters[] = $value;
        } else {
            $this->parameters[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->parameters[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->parameters[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->parameters[$offset]) ? $this->parameters[$offset] : null;
    }

    /**
     * all
     *
     * @return array
     */
    public function all()
    {
        return $this->parameters;
    }
}
