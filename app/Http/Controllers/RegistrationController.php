<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    private $apiBaseUrl = 'http://localhost:8000/api';

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        // Send POST request to the API
        $response = Http::timeout(60)->post("{$this->apiBaseUrl}/registration", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        if ($response->successful()) {
            return redirect()->route('register')->with('success', 'Registration successful!');
        } else {

            $errors = $response->json()['errors'] ?? ['Something went wrong, please try again.'];
            return back()->withErrors($errors)->withInput();
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);


        $response = Http::post('http://localhost:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {

            $token = $response->json()['token'];

            // Store  token in session
            session(['api_token' => $token]);

            return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
        } else {

            $errorMessage = $response->json()['message'] ?? 'Invalid credentials';
            return back()->withErrors(['email' => $errorMessage])->withInput();
        }
    }

    public function logout()
    {

        session()->forget('api_token');
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
