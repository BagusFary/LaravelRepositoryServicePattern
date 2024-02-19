<?php
namespace App\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ProfileRepository;
    
class ProfileService
{

    protected $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findById($id)
    {
        $result = $this->repository->find($id);
        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    public function create($data)
    {
        $this->repository->create($data);
        return response()->json([
            'success' => true,
            'message' => 'Create data Success'
        ]);
    }

    public function update($data)
    {

        $this->repository->updateData($data);
        return response()->json([
            'success' => true,
            'message' => 'Update data Success'
        ]);

    }

    public function changePassword($data)
    {
        $new_password = strval($data['new_password']);

        $password_temp = $this->repository->find(1);

        if(!Hash::check($data['old_password'],$password_temp['password']))

        {
            return response()->json([
                'message' => 'Password is not the same'
            ]);
        }

        elseif(Hash::check($data['new_password'], $password_temp['password']))

        {
            return response()->json([
                'message' => 'Your new password is the same as your old password'
            ]);
        }

        $this->repository->changePassword($new_password);
        return response()->json([
            'success' => true,
            'message' => 'Change password success!'
        ]);

    }
}
        