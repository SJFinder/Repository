<?php

namespace SJFinder\Repository\Contracts;

interface PresenterInterface
{
    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data);
}
