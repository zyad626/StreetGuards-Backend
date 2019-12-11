<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('admin.language-setter');
        $this->middleware('admin.auth', ['except' => $this->skipAuthentication()]);
        \Auth::shouldUse('admin');
        // $view = app()['view'];

        // $view->getFinder()->prependLocation(resource_path('views/admin'));
    }

    protected function skipAuthentication()
    {
        return [];
    }

    protected function getCurrentUser()
    {
        return \Auth::guard('admin')->user();
    }

}
