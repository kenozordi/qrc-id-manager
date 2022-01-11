<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\ResponseFormat;
use App\Services\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminApi extends Controller
{
    /**
     * Class properties 
     * 
     * @var
     */
    protected $adminService;

    /**
     * Class constructor 
     * 
     * @var
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * **used to authenticate user**
     * @param \Illuminate\Http\Request $request containing user credentials
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validations::$LoginAdmin);
            if ($validator->fails()) return ResponseFormat::returnFailed(Validations::formatError($validator->errors()));

            if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))) {
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnFailed("Failed to Login Admin");

        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnSystemFailure();
        }
    }

    /**
     * Check if admin is authenticated
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkAuth()
    {
        try {
            if (Auth::guard('admin')->check()) {
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
     * Log admin out
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            if (Auth::guard('admin')->logout()) {
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
     * Create an admin
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validations::$CreateAdmin);
            if ($validator->fails()) return ResponseFormat::returnFailed(Validations::formatError($validator->errors()));

            $validated = $validator->validated();
            $admin = $this->adminService->store($validated);

            if ($admin) {
                return ResponseFormat::returnSuccess($admin);
            } else {
                return ResponseFormat::returnFailed("Failed to save new Admin");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }


    /**
     * Get admin details
     * 
     * @param string $id of admin
     * @return \Illuminate\Http\Response
     */
    public function info($id)
    {
        try {            
            $admin = $this->adminService->getRecord('id', $id);
    
            if ($admin) {
                return ResponseFormat::returnSuccess($admin);
            } else {
                return ResponseFormat::returnNotFound("Admin not found");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return ResponseFormat::returnSystemFailure();
        }
    }
}