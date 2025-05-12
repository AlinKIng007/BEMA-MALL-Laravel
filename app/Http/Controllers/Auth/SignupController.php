<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
        return view('auth.signup', compact('countries'));
    }

public function signup(Request $request)
{
    // 1. Validate the input data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'required|string|max:20',
        'city' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
        'address' => 'required|string|max:255',
        'zip_code' => 'required|max:11',
        'username' => 'required|string|max:255|unique:users',
        'hash' => 'required|string|min:8',  // Ensure password is confirmed
    ]);

    // 2. Generate a random salt for the user
    $salt = Str::random(32);

    // 3. Get the pepper from the .env file
    $pepper = env('PEPPER');

    // 4. Combine the salt, password, and pepper and hash the final value
    $passwordToHash = $salt . $validated['hash'] . $pepper;
    $hashedPassword = Hash::make($passwordToHash, [
        'rounds' => 13,
    ]);

    // 5. Insert user data into the database
    DB::table('users')->insert([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        'city' => $validated['city'],
        'country_id' => $validated['country_id'],
        'address' => $validated['address'],
        'zip_code' => $validated['zip_code'],
        'username' => $validated['username'],
        'hash' => $hashedPassword,  // Store the hashed password
        'salt' => $salt,  // Store the salt
        'remember_token' => Str::random(10),  // Optional if needed for "remember me" functionality
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 6. Log the user in after account creation
    $user = DB::table('users')->where('username', $validated['username'])->first();
    Auth::loginUsingId($user->id);

    // 7. Redirect to home or wherever you need after successful signup
    return redirect("/")->with('success', 'Account created successfully!');
}

}
