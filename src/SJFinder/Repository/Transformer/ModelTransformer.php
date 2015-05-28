<?php

namespace SJFinder\Repository\Transformer;

use League\Fractal\TransformerAbstract;
use SJFinder\Repository\Contracts\Transformable;

class ModelTransformer extends TransformerAbstract
{
    /**
     * @param Transformable $model
     *
     * @return array
     */
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}
