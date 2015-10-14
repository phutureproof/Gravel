<?php

namespace Gravel;

class Collection implements \Countable, \JsonSerializable
{
    public $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function count()
    {
        return count($this->data);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    public function __toString()
    {
        return json_encode($this->data);
    }
}