<?php declare(strict_types=1);

namespace spf\web;

use ArrayAccess;
use LogicException;

class Config implements ArrayAccess {

    protected array $data;

    protected array $cache;

    public function __construct( array $data = [] ) {

        $this->data  = $data;
        $this->cache = [];

    }

    public function has( $key ) {
        return $this->get($key, null) !== null;
    }

    public function get( $key, $default = null ) {

        if( isset($this->cache[$key]) ) {
            return $this->cache[$key];
        }

        $parts   = explode('.', $key);
        $context = $this->data;

        foreach( $parts as $part ) {
            if( !isset($context[$part]) ) {
                return $default;
            }
            $context = $context[$part];
        }

        $this->cache[$key] = $context;

        return $context;

    }

    public function offsetExists( $offset ) {
        return $this->has($offset);
    }

    public function offsetGet( $offset ) {
        return $this->get($offset);
    }

    public function offsetSet( $offset, $value ) {
        throw new LogicException(static::class. ' is immutable');
    }

    public function offsetUnset( $offset ) {
        throw new LogicException(static::class. ' is immutable');
    }

}
