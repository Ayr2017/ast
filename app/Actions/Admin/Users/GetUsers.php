<?php

namespace App\Actions\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetUsers
{
    public function execute($request)
    {
        if($request->select == 'withoutTrashed' ) {
            $users = User::with('roles');
        } elseif($request->select == 'trashed' ){
            $users = User::onlyTrashed()->with('roles');
        } else {
            $users = User::withTrashed()->with('roles');
        }

        return $this->filterUsers($users);
    }

    private function filterUsers( $users)
    {
        $user = auth()->user();

        if($user->hasRole('super-admin')){
            return $users->where('id', '!=', $user->id)->get();
        } elseif($user->hasRole('admin')){
//            TODO: доделать это место. Выводить только тех кто не админ и суперадмин.
            $newUsers =  $users->doesntHave('roles')->get();
            return  $users->role('specialist')->get()->merge($newUsers);
        }
    }
}
