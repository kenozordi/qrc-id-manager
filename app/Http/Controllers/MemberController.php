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
    public function getMember($qr_id)
    {
        $response = $this->memberApi->info($qr_id)->getData();
        $member = $response->code == "00" ? $response->data : null;

        //return view here
    }
}
