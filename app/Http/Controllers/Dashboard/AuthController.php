<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Auth\Login;
use App\Models\Admin;

class AuthController extends GeneralController
{
    protected $viewPath = 'auth.';
    protected $urlPath = 'login';

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }


    /**
     * Show Page Login Admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view($this->viewPath($this->viewPath . 'login'));
    }


    /**
     * Login Admin
     * @param Login $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Login $request)
    {
        // Get Data Credentials Request
        $credentials = request(['email', 'password']);
        // store remember in var if true or false
        $remember = $request->input('remember') ? true : false;
        // IF Invalid Credentials Return Back
        if(!auth('admin')->attempt($credentials, $remember)) return back()->with('error', __('lang.error_login'));
        // Logged Admin
        return redirect($this->urlPath('/'));
    }


    /**
     * Logout Admin
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if(auth('admin')->check()){
            auth('admin')->logout();
        }
        return redirect($this->urlPath($this->urlPath));
    }
}
