<?php

namespace App\Http\Middleware\Roles\Branch;

use Closure;
use App\Http\Controllers\RoleManageController;
use Illuminate\Support\Facades\Session;
class Pdf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (config('role_manage.Project.Pdf')){ //PDF
            return $next($request);
        }else{
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->back();
        }
    }
}
