<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username (){
        return 'name';
    }

    /**
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        $admin = Admin::query()->firstOrNew(['name' => $request->name]);

        if(!$admin->id) {
            $this->throwValidate();
        }

        if(!Hash::check($request->password, $admin->password)) {
            $this->throwValidate();
        }

        $token = $admin->createToken('adminToken');

        return $token;

    }

    public function logout (Request $request){
        $token = Auth::user()->token();
        $token->revoke();

        return response()->json([true]);
    }

    /**
     * @throws ValidationException
     */
    private function throwValidate() {
        throw ValidationException::withMessages(['Unauthenticated.']);
    }
}
