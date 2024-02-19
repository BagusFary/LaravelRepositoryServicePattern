<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;

class ProfileRepository extends BaseRepository
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        // Add your boot logic here
    }

    public function create($data)
    {
            $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

    public function updateData($data)
    {
        $this->model->where('id',11)->update($data);
    }

    public function changePassword($data)
    {
        $this->model->where('id',1)->update([
            'password' => Hash::make($data)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
    
}
    