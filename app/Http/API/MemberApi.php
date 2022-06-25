<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use Illuminate\Http\Request;
use App\Services\Validations;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MemberApi extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    protected $memberService;


    /**
     * Class constructor 
     * 
     */
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    /**
     * **used to authenticate user**
     * @param \Illuminate\Http\Request $request containing user credentials
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validations::$LoginMember);
            if ($validator->fails()) return ResponseFormat::returnFailed(Validations::formatError($validator->errors()));

            if (Auth::guard('member')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                $member = $this->memberService->getRecord('email', $request->email);
                return ResponseFormat::returnSuccess($member);
            }
            return ResponseFormat::returnFailed("Failed to Login Member");
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnSystemFailure();
        }
    }

    /**
     * Check if member is authenticated
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkAuth()
    {
        try {
            if (Auth::guard('member')->check()) {
                return ResponseFormat::returnSuccess();
            } else {
                return ResponseFormat::returnFailed();
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnSystemFailure();
        }
    }

    /**
     * Log member out
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            if (Auth::guard('member')->logout()) {
                return ResponseFormat::returnSuccess();
            } else {
                return ResponseFormat::returnFailed();
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnSystemFailure();
        }
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
                return ResponseFormat::returnFailed("Failed to save new Member");
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

    /**
     * Upload member QR Code
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function uploadCode($request)
    {
        try {
            $result = $this->memberService->uploadCode($request);

            if ($result) {
                return ResponseFormat::returnSuccess();
            } else {
                return ResponseFormat::returnNotFound("Member not found");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }

    /**
     * Get all members details
     * 
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        try {
            $members = $this->memberService->getAll();

            if ($members) {
                return ResponseFormat::returnSuccess($members);
            } else {
                return ResponseFormat::returnNotFound("Failed to get members");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }

    /**
     * Update member details
     * @param string $qr_id A unique id tied to a members QR Code
     * @return \Illuminate\Http\Response
     */
    public function update($qr_id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validations::$UpdateMember);
            if ($validator->fails()) return ResponseFormat::returnFailed(Validations::formatError($validator->errors()));

            $detailsToUpdate = $validator->validated();

            $member = $this->memberService->getRecord('qr_id', $qr_id);
            if ($member) {
                $updatedMember = $this->memberService->update($detailsToUpdate, $member->id);
                return ResponseFormat::returnSuccess($updatedMember);
            } else {
                return ResponseFormat::returnNotFound("Failed to get members");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }
}
