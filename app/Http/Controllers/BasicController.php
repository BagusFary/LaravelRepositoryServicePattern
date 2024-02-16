<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Repositories\Data\DataRepositoryInterface;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    protected $DataRepositoryInterface;

    public function __construct(DataRepositoryInterface $DataRepositoryInterface)
    {
        $this->DataRepositoryInterface = $DataRepositoryInterface;
    }

    public function findDataId($id)
    {
        $data = $this->DataRepositoryInterface->getDataById($id);
        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $data
        ]);
    }

    public function findName($request)
    {
        $data = $this->DataRepositoryInterface->getDataByName($request);
        return response()->json([
            'data' => $data 
        ]);
    }
    
}
