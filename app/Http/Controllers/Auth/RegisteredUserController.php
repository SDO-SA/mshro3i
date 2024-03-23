<?php

namespace App\Http\Controllers\Auth;

use App\Base\RolesList;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Department;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\States\StudentStates;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = Department::all();
        $colleges = College::all();

        return view('auth.register', compact('departments', 'colleges'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'university_id' => ['required', 'integer', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'email' => $request->email,
            'college_id' => $request->college,
            'department_id' => $request->department,
            'state' => StudentStates::NotJoined,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole(RolesList::ROLE_STUDENT);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
