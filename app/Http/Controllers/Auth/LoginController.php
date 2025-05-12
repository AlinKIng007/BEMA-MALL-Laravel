<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


public function login(Request $request)
{
    // 1. Validate form input
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $usernameOrEmail = $credentials['username'];
    $inputPassword = $credentials['password'];

    // 2. Query user and associated data
    $user = DB::table('users')
        ->leftJoin('employees', 'users.id', '=', 'employees.user_id')
        ->leftJoin('roles', 'employees.id', '=', 'roles.employee_id')
        ->leftJoin('titles', 'roles.title_id', '=', 'titles.id')
        ->leftJoin('department_employee', 'employees.id', '=', 'department_employee.employee_id')
        ->leftJoin('departments', 'department_employee.department_id', '=', 'departments.id')
        ->select(
            'departments.mall_id as mall_id',
            DB::raw('COALESCE(titles.allowance, 0) as role_id'),
            'users.id as id',
            'users.username as username',
            'users.email as email',
            'users.salt as salt',
            'users.hash as hash',
            'employees.id as emp_id'
        )
        ->where(function ($query) use ($usernameOrEmail) {
            $query->where('users.username', $usernameOrEmail)
                  ->orWhere('users.email', $usernameOrEmail);
        })
        ->first();

    // 3. If user exists, verify password
    if ($user) {
        $pepper = env('PEPPER');


        if (Hash::check($user->salt . $inputPassword . $pepper, $user->hash)) {
            // Authenticated
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();
            return redirect('/');
        } else {
            // Wrong password
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput($request->except('password'));
        }
    }

    // 4. User not found
    return back()->withErrors([
        'username' => 'No account found with that username or email.',
    ])->withInput($request->except('password'));
}





    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
