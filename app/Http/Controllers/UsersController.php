<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Pekerjaan;
use App\Models\Tfl;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created user
     *
     * @param  User  $user
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {

    }

    public function lokasi(Request $request)
    {

    }

    /**
     * Show user data
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Edit user data
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    }

    /**
     * Update user data
     *
     * @param  User  $user
     * @param  UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {

    }

    /**
     * Delete user data
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

    }
}
