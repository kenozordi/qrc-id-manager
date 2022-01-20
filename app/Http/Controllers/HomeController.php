<?php

namespace App\Http\Controllers;

use App\Http\API\MemberApi;

class HomeController extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    protected $memberApi;

    /**
     * Class constructor 
     * 
     * @var
     */
    public function __construct(MemberApi $memberApi)
    {
        $this->memberApi = $memberApi;
    }

    /**
     * Show member details to the public
     * 
     * @param string $qr_id A unique id tied to a members QR Code
     * @return view
     */
    public function search($qr_id)
    {
        $page_title = "Profile";
        
        $response = $this->memberApi->info($qr_id)->getData();
        $member = $response->code == "00" ? $response->data : null;
        
        if ($member) {
            return view('search.member', compact('member', 'page_title'));
        } else {
            return view('admin.members.notFound');
        }
    }
}
