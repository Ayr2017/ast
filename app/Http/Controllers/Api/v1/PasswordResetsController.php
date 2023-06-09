<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;


class PasswordResetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passwordResets = PasswordReset::all();
        return response($passwordResets, 200);
    }

    public function updateOrCreate(Request $request, $email)
    {
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $email],
            [
                'token' => Str::uuid(),
                'created_at' => Carbon::now()
            ]
        );

        return response(['passwordReset' => $passwordReset], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
