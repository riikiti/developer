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
        match ($request->query('loaderType')){
            'sql'=> $result = $this->unselectedService->getFromSql($request->header('User-Id')),
            'inMemory'=>$result = $this->unselectedService->getFromMemory($request->header('User-Id')),
            default => $result =['msg'=>'Опции не существует']
        };
        return $result;
    }
}
