<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Role;
use Validator;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\API\BaseController as BaseController;

class UsersController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'last') {
            $getLast = User::select('users.*', DB::raw('GROUP_CONCAT(`roles`.`nama`  SEPARATOR ",") AS role'))
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->groupBy('users.id')
                        ->where('users.id', '<>', 1)
                        ->paginate($item);
            $currentPage = $getLast->lastPage();
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }
        if ($request->page == 'findme') {
            $getData = User::get();
            $number = 0;
            foreach ($getData as $key => $value) {
                if ($value->id==$request->idnow) {
                    $number = $key+1;
                    $currentPage = ceil($number/$item);
                    break;
                }
            }
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }
        // $query->where('name', 'like', '%'.$search.'%')
        //     ->orWhere('email', 'like', '%'.$search.'%');
        if($search!=""){
            $data['users'] = User::select('users.*', DB::raw('GROUP_CONCAT(`roles`.`nama`  SEPARATOR ",") AS role'))
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->groupBy('users.id')
                        ->where('users.id', '<>', 1)
                        ->where(function ($query) use ($search){
                            $query->where('users.name', 'like', '%'.$search.'%')
                                ->orWhere('users.email', 'like', '%'.$search.'%')
                                ->orWhere('users.username', 'like', '%'.$search.'%')
                                ->orWhere('roles.nama', 'like', '%'.$search.'%');
                        })
                        ->paginate($item);
        }else{
            $data['users'] = User::select('users.*', DB::raw('GROUP_CONCAT(`roles`.`nama`  SEPARATOR ",") AS role'))
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->groupBy('users.id')
                        ->where('users.id', '<>', 1)
                        ->paginate($item);
        }
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/long.log'),
                ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access List User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
            return $this->sendResponse($data['users'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/long.log'),
                ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access List User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
            return view('admin.users.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new User;
        $table->name = $request->name;
        $table->username = $request->username;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);
        
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Store User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()){
            $userrole = explode(',', $request->role);
            foreach ($userrole as $key => $r) {
                $datarole[] = $r;
            }
            $table->roles()->sync($datarole);
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id)
    {
        $table = User::select('users.*', DB::raw('GROUP_CONCAT(`roles`.`id`  SEPARATOR ",") AS role'))
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->groupBy('users.id')
                    ->where('users.id', $id)
                    ->first();
        
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Edit User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->password) {
            $bypass = false;
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'string'],
            ]);
        } else {
            $bypass = true;
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => ['required', 'string'],
            ]);
        }

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = User::where('id', $request->id)->first();
        $table->name = $request->name;
        $table->username = $request->username;
        $table->email = $request->email;
        if (!$bypass) {
            $table->password = Hash::make($request->password);
        }
        
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Update User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()){
            $userrole = explode(',', $request->role);
            foreach ($userrole as $key => $r) {
                $datarole[] = $r;
            }
            $table->roles()->sync($datarole);
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = User::where('id', $id)->first();
        
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Delete User' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()){
            DB::table('role_user')->where('user_id', $id)->delete();
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
