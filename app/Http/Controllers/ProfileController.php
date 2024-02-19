<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    protected $service;
    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
         return $this->service->findById(10);
    }

    public function create(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => ['required','string','max:100'],
                'email' => ['required','string','lowercase', 'email','max:100', 'unique:users,email'],
                'password' => ['required', 'min:8']
            ]);
        }

        catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->service->create($validated);
        
    }

    public function update(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => ['string','max:100'],
                'email' => ['string','lowercase','email','max:100','unique:users,email'],
            ]);
        }

        catch (ValidationException $e){
            $errors = $e->validator->errors();
            return response()->json(['message' => 'Update data failed.', 'errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


        return $this->service->update($validated);
    }

    public function changePassword(Request $request)
    {
        try{
            $validated = $request->validate([
                'old_password' => ['min:8'],
                'new_password' => ['min:8']
            ]);
        }
        catch(ValidationException $e)
        {
            $errors = $e->validator->errors();
            return response()->json(['message' => "Reset password failed.", 'errors' => $errors]);
        }

        return $this->service->changePassword($validated);
    }
}
