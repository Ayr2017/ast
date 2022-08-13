<?php

namespace App\Actions\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetUsers
{
    public function execute($request)
    {
        if($request->select == 'withTrashed' ) {
            $users = User::withTrashed()->with('roles')->get();
        } elseif($request->select == 'trashed' ){
            $users = User::onlyTrashed()->with('roles')->get();
        } else {
            $users = User::with('roles')->get();
        }

        return $this->filterUsers($users);
    }

    private function filterUsers(Collection $users)
    {
        $user = auth()->user();

        if($user->hasRole('super-admin')){
            return $users->where('id', '!=', $user->id);
        } if($user->hasRole('admin')){
            return $users->whereHas('roles', function($query){
                return $query->whereNotIn('name', ['admin','super-admin']);
            });
        }
    }
}
