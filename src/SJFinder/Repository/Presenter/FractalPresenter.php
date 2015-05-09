<?php namespace SJFinder\Repository\Presenter;

use Illuminate\Pagination\AbstractPaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\TransformerAbstract;
use SJFinder\Repository\Contracts\PresenterInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class FractalPresenter implements PresenterInterface
{
    /**
     * @var string
     */
    protected $resourceKeyItem = null;

    /**
     * @var string
     */
    protected $resourceKeyCollection = null;

    /**
     * @var Manager
     */
    protected $fractal = null;

    /**
     * @var Collection
     */
    protected $resource = null;

    /**
     *
     */
    public function __construct()
    {
        $this->fractal = new Manager();
        $this->parseIncludes();
        $this->setupSerializer();
    }

    /**
     * @return $this
     */
    protected function setupSerializer()
    {
        $serializer = $this->serializer();

        if ($serializer instanceof SerializerAbstract) {
            $this->fractal->setSerializer($serializer);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function parseIncludes()
    {
        $request        = app('Illuminate\Http\Request');
        $paramIncludes  = config('repository.fractal.params.include', 'include');

        if ($request->has($paramIncludes)) {
            $this->fractal->parseIncludes($request->get($paramIncludes));
        }

        return $this;
    }

    /**
     * Get Serializer
     *
     * @return SerializerAbstract
     */
    public function serializer()
    {
        return null;
    }

    /**
     * Transformer
     *
     * @return TransformerAbstract
     */
    abstract public function getTransformer();

    /**
     * Prepare data to present
     *
     * @param $data
     * @return array
     */
    public function present($data)
    {
        if ($data instanceof EloquentCollection) {
            $this->resource = $this->transformCollection($data);
        } else if ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }

        return $this->fractal->createData($this->resource)->toArray();
    }

    /**
     * @param $data
     * @return Item
     */
    protected function transformItem($data)
    {
        return new Item($data, $this->getTransformer(), $this->resourceKeyItem);
    }

    /**
     * @param $data
     * @return Collection
     */
    protected function transformCollection($data)
    {
        return new Collection($data, $this->getTransformer(), $this->resourceKeyCollection);
    }

    /**
     * @param AbstractPaginator|LengthAwarePaginator|Paginator $paginator
     * @return Collection
     */
    protected function transformPaginator($paginator)
    {
        $collection = $paginator->getCollection();
        $resource = new Collection($collection, $this->getTransformer(), $this->resourceKeyCollection);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $resource;
    }

}