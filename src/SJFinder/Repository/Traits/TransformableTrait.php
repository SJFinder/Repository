<?php

namespace SJFinder\Repository\Traits;

trait TransformableTrait
{
    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }
}
