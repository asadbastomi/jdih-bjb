<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Role;
use Validator;
use Cookie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends BaseController
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $ipKey = 'login-attempt:' . $request->ip(); // tracking based on IP

        // Validasi awal
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    
        // Jika melebihi batas, wajib isi CAPTCHA
        if (RateLimiter::tooManyAttempts($ipKey, 5)) {
            $rules['captcha'] = 'required|captcha';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
    
        // Tentukan login via username/email
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password
        ];
    
        // Coba login
        if (auth()->attempt($credentials)) {
            RateLimiter::clear($ipKey); // reset limiter jika berhasil
    
            $user = Auth::user();
            if ($request->remember_me) {
                Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(3));
            }
    
            $theToken = $user->createToken(env('APP_NAME', 'doFapps'));
            $success['expired'] = Carbon::parse($theToken->token->expires_at)->toDateTimeString();
            $success['token'] = $theToken->accessToken;
            $success['name'] = $user->name;
            $more['auth'] = 'login';
            $more['cookie'] = $this->getCookieDetails($success['token']);
    
            return $this->sendResponse($success, 'User login successfully.', $more);
        } else {
            RateLimiter::hit($ipKey, 60); // tambah hit selama 1 menit
    
            return $this->sendError(null, 'User and/or Password wrong', 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'required_with:confirm_password|same:confirm_password'],
            'term' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        // $user = User::create($data);
        // if ($user) {
        //     $userRole = Role::where('nama', 'user')->first();
        //     $user->roles()->attach($userRole);

        $success['name'] = $data['name'];
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/regis.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : Regis Sukses = ' . $data['name'] . ' - ' . $data['username'] . ' - ' . $data['email'] . ' - ' . $request->password . ' -#- ' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
            return $this->sendResponse($success, 'User register successfully');
        // } else {
        //     return $this->sendError(null, 'User register failed', 500);
        // }
    }

    public function userDetail()
    {
        $user = Auth::user();
        return $user ? $this->sendResponse($user, 'Data success retrieved')
                   : $this->sendError(null, 'Unauthorised', 401);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation Error');
            }
            $table = User::where('id', $user->id)->first();
            $table->password = Hash::make($request->password);
            if ($table->save()){
                return $this->sendResponse($user, 'Password success changed');
            } else {
                return $this->sendError(null, 'Change password failed', 500);
            }
        } else {
            return $this->sendError(null, 'Unauthorised', 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $token = $user->token();
            if ($token) {
                $token->revoke();
            }
        }
        $more['auth'] = 'logout';
        $more['cookie'] = Cookie::forget('_token');
        return $this->sendResponse($user, 'Successfully logged out', $more);
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => env('SESSION_LIFETIME'),
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => 'lax',
        ];
    }

}
