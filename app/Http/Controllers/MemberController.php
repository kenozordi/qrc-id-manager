<?php

namespace App\Http\Controllers;

use App\Http\API\MemberApi;

class MemberController extends Controller
{

    protected $memberApi;

    public function __construct(MemberApi $memberApi)
    {
        $this->memberApi = $memberApi;
    }
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
}
