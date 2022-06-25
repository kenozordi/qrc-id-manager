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
     * @param string $qr_id A unique id tied to a members 
     */
    public function info($qr_id)
    {
        $page_title = "Profile";

        $response = $this->memberApi->info($qr_id)->getData();
        $member = $response->code == "00" ? $response->data : null;

        if ($member) {
            return view('member.profile', compact('member', 'page_title'));
        } else {
            return view('member.layout.notFound');
        }
    }

    /**
     * Show member dashboard
     * 
     * @param string $uuid member uuid
     */
    public function dashboard($uuid)
    {
        $page_title = "Dashboard";

        $response = $this->memberApi->info($uuid)->getData();
        $member = $response->code == "00" ? $response->data : null;

        if ($member) {
            return view('member.dashboard', compact('member', 'page_title'));
        } else {
            return view('admin.members.notFound');
        }
    }

    /**
     * Upooad member QR Code
     * 
     * @param \Illuminate\Http\Request
     */
    public function uploadCode(Request $request)
    {
        $response = $this->memberApi->uploadCode($request)->getData();
        $result = $response->code == "00" ? true : false;

        if ($result) {
            return back();
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
        $response = $this->memberApi->authenticate($request)->getData();
        $member = $response->code == "00" ? $response->data : null;

        if ($member) {
            return redirect()
                ->intended(route('member.dashboard', ['qr_id' => $member->qr_id]))
                ->with('status', 'You are logged in successfullly');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Login failed, please try again!');
        }
    }

    /**
     * Show Member registeration form
     * 
     */
    public function registerForm()
    {
        return view("member.registerForm");
    }

    /**
     * Submit Member registeration form
     * 
     * @param \Illuminate\Http\Request
     */
    public function register(Request $request)
    {
        $response = $this->memberApi->store($request)->getData();
        $member = $response->code == "00" ? $response->data : null;

        if ($member) {
            return redirect()->route('member.dashboard', ['uuid' => $member->uuid])
                ->with('status', 'Registration successfullly');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Registration failed, please try again!');
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
