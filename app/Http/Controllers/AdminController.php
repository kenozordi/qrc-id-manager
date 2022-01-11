<?php

namespace App\Http\Controllers;

use App\Http\API\AdminApi;
use App\Http\API\MemberApi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    protected $adminApi, $memberApi;

    /**
     * Class constructor 
     * 
     * @var
     */
    public function __construct(AdminApi $adminApi, MemberApi $memberApi)
    {
        $this->adminApi = $adminApi;
        $this->memberApi = $memberApi;
    }

    /**
     * Authenticate admin
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $response = $this->adminApi->authenticate($request)->getData();
        $result = $response->code == "00" ? true : false;

        if ($result) {
            return redirect()
            ->intended(route('admin.dashboard'))
            ->with('status', 'You are logged in successfullly');
        } else {
            return back()
            ->withInput()
            ->with('error','Login failed, please try again!');
        }
    }

    /**
     * Show Admin login form
     * 
     */
    public function login()
    {
        if ($this->adminApi->checkAuth()->getData()->code == "00") {
            return redirect()->route('admin.dashboard');
        }

        return view("admin.login");
    }

    /**
     * Log Admin out and Show Admin login form
     * 
     */
    public function logout()
    {
        if ($this->adminApi->logout()->getData()->code == "00") {
            return redirect()->route('admin.login');
        }

        return back();
    }
    
    /**
     * Show Admin dashboard
     * 
     */
    public function dashboard(Request $request)
    {
        $page_title = "Dashboard";

        $response = $this->memberApi->all()->getData();
        $members = $response->code == "00" ? $response->data : null;

        return view("admin.dashboard", compact('page_title', 'members'));
    }

    /**
     * Show admin details
     * 
     * @param string $id of admin
     * @return \Illuminate\Http\Response
     */
    public function info($qr_id)
    {
        $page_title = "Profile";
        
        $response = $this->adminApi->info($qr_id)->getData();
        $admin = $response->code == "00" ? $response->data : null;
        
        if ($admin) {
            return view('admin.admins.admin', compact('admin', 'page_title'));
        } else {
            return view('admin.admins.notFound');
        }
    }
}
