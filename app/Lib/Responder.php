<?php
namespace App\Lib;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class Responder
{
    protected $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();
        $this->fractal->setSerializer(new ArraySerializer());
    }

    public function collectionPage($page, $transformer)
    {
        $resource = new Collection($page, $transformer);

        $resource->setPaginator(new IlluminatePaginatorAdapter($page));
        return $this->fractal->createData($resource)->toArray();
    }

    public function itemResponse($item, $transformer)
    {
        $resource = new Item($item, $transformer);

        return $this->fractal->createData($resource)->toArray();
    }

    public function collectionResponse($collection, $transformer)
    {
        $resource = new Collection($collection, $transformer);

        return $this->fractal->createData($resource)->toArray();
    }
}
