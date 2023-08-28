<?php

namespace Core\Classes\Dto\Concerns;

trait Constructable
{
    public function __construct(array $params)
    {
        $properties = get_class_vars(static::class);
        foreach (array_keys($properties) as $property) {
            $this->$property = $params[$property] ?? null;
        }
    }
}
