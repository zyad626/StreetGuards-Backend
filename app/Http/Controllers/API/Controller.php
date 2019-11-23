<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\TransformerAbstract;

use App\Lib\Responder;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $responder;

    protected function responder()
    {
        if (!$this->responder) {
            $this->responder = new Responder();
        }

        return $this->responder;
    }
    
    /**
     * return page json response
     *
     * @param AbstractPaginator $paginator
     * @param TransformerAbstract $transformer
     * @return void
     */
    protected function pageResponse(AbstractPaginator $paginator, TransformerAbstract $transformer)
    {
        return $this->responder()->collectionPage($paginator, $transformer);
    }

    protected function itemResponse($item, TransformerAbstract $transformer)
    {
        return $this->responder()->itemResponse($item, $transformer);
    }

    protected function collectionResponse($items, TransformerAbstract $transformer)
    {
        return $this->responder()->collectionResponse($items, $transformer);
    }

    protected function successResponse($code = 200)
    {
        return response()->json(['success' => 'true'], $code);
    }
}
