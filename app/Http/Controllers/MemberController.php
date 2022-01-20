<?php

namespace App\Http\Controllers;

use App\Http\API\MemberApi;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    protected $memberApi, $memberService;

    /**
     * Class constructor 
     * 
     * @var
     */
    public function __construct(MemberApi $memberApi, MemberService $memberService)
    {
        $this->memberApi = $memberApi;
        $this->memberService = $memberService;
    }

    /**
     * Show member details
     * 
     * @param string $qr_id A unique id tied to a members QR Code
     */
    public function info($qr_id)
    {
        $page_title = "Profile";
        
        $response = $this->memberApi->info($qr_id)->getData();
        $member = $response->code == "00" ? $response->data : null;
        
        if ($member) {
            return view('admin.members.member', compact('member', 'page_title'));
        } else {
            return view('admin.members.notFound');
        }
    }

    /**
     * Show member dashboard
     * 
     * @param string $qr_id A unique id tied to a members QR Code
     */
    public function dashboard($qr_id)
    {
        $page_title = "Dashboard";
        
        $response = $this->memberApi->info($qr_id)->getData();
        $member = $response->code == "00" ? $response->data : null;
        
        if ($member) {
            return view('member.dashboard', compact('member', 'page_title'));
        } else {
            return view('admin.members.notFound');
        }
    }


    /**
     * Authenticate member
     * 
     * @param \Illuminate\Http\Request
     */
    public function auth(Request $request)
    {
        $memberCredentials = $request->only('email', 'password');

        // This will be replaced by member auth guard
        $defaultPass = "1234";
        $member = $this->memberService->getRecord('email', $memberCredentials['email']);

        if ($member && $memberCredentials['password'] == $defaultPass) {
            return view('member.dashboard', compact('member'))
                ->with('status', 'You are logged in successfullly');
        } else {
            return back()
            ->withInput()
            ->with('error','Login failed, please try again!');
        }
    }

    /**
     * Show Member login form
     * 
     */
    public function login()
    {
        
        return view("member.login");
    }


    /**
     * Log Member out and Show Member login form
     * 
     */
    public function logout()
    {
        return redirect()->route('member.login');

    }
    

}
