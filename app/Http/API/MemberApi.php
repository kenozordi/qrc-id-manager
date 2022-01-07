<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use Illuminate\Http\Request;
use App\Services\Validations;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MemberApi extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    private $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    /**
     * Create a member
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validations::$CreateMember);
            if ($validator->fails()) return ResponseFormat::returnFailed(Validations::formatError($validator->errors()));
    
            $validated = $validator->validated();
            $member = $this->memberService->store($validated);
    
            if ($member) {
                return ResponseFormat::returnSuccess($member);
            } else {
                return ResponseFormat::returnFailed("Unable to save new member");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }

    }

    /**
     * Get member details
     * 
     * @param string $qr_id A unique id tied to a members QR Code
     * @return \Illuminate\Http\Response
     */
    public function info($qr_id)
    {
        try {            
            $member = $this->memberService->getRecord('qr_id', $qr_id);
    
            if ($member) {
                return ResponseFormat::returnSuccess($member);
            } else {
                return ResponseFormat::returnNotFound("Member not found");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }
}