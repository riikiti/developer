<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\Unselected\UnselectedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class UnselectedController extends Controller
{

    public function __construct(public UnselectedService $unselectedService)
    {
    }
    public function __invoke(Request $request)
    {

        try {
            $loaderType = $request->query('loaderType');
            $value = $request->header('User-Id');
            if (empty($value)) {
                $data = [
                    'status' => 401,
                    'error' => 'Unauthorized'
                ];
                return response()->json($data, 401);
            } else {
                switch ($loaderType) {
                    case "sql":
                        return $this->unselectedService->getFromSql($value);
                    case "inMemory":
                        return $this->unselectedService->getFromMemory($value);
                    default:
                        $data = [
                            'status' => 501,
                            'error' => 'Not Implemented'
                        ];
                        return response()->json($data, 501);
                }
            }
        } catch (\Exception $exception) {
            $data = [
                'status' => 500,
                'error' => 'Internal Server Error'
            ];
            return response()->json($data, 500);
        }


    }
}
