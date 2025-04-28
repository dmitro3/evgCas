<?php
namespace App\Http\Service\User\Action;

use App\Http\Requests\KycApplicationRequest;
use App\Models\User;
use App\Models\VerificationApplication;

class CreateKycApplication
{
    public function create(KycApplicationRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        if ($user->kyc_step !== 1) {
            return response()->json([
                'message' => 'Kyc application already exists',
            ], 400);
        }
        $verificationApplication             = new VerificationApplication();
        $verificationApplication->user_id    = $user->id;
        $verificationApplication->first_name = $request->firstName;
        $verificationApplication->last_name  = $request->lastName;
        $verificationApplication->birth_date = $request->birthDate;
        $verificationApplication->country    = $request->country;
        $verificationApplication->save();

        return response()->json([
            'message'                 => 'Kyc application created successfully',
            'verificationApplication' => $verificationApplication,
        ], 201);
    }
}
