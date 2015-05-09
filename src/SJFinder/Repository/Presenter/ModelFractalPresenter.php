<?php namespace SJFinder\Repository\Presenter;

use SJFinder\Repository\Transformer\ModelTransformer;

class ModelFractalPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ModelTransformer();
    }

}