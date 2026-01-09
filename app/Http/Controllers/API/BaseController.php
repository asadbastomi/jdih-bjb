<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Pagination\Paginator;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $more = null)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        if (!$more) {
            return response()->json($response, 200);
        } elseif ($more['auth'] == 'login') {
            $cookie = $more['cookie'];
            return response()
                ->json($response, 200)
                ->withCookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
        } elseif ($more['auth'] == 'logout') {
            $cookie = $more['cookie'];
            return response()
                ->json($response, 200)
                ->withCookie($cookie);
        }
    }

    public function sendError($errorList = [], $message, $code = 400)
    {
        // 400 = Validiator Failed
        // 401 = Unauthorize
        // 500 = Server Error
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if (!empty($errorList)) {
            $response['data'] = $errorList;
        }
        return response()->json($response, $code);
    }

    public function getLastPage($table)
    {
        $currentPage = $table->lastPage();
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
    }

    public function findMe($table)
    {
        // $number = 0;
        // foreach ($table as $key => $value) {
        //     if ($value->id==$request->idnow) {
        //         $number = $key+1;
        //         $currentPage = ceil($number/$item);
        //         break;
        //     }
        // }
        // Paginator::currentPageResolver(function () use ($currentPage) {
        //     return $currentPage;
        // });
    }
}
