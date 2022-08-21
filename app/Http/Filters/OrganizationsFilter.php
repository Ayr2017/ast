<?php

namespace App\Http\Filters;

class OrganizationsFilter extends QueryFilter
{
    public function select(string $select)
    {
        if($select == 'withTrashed'){
            $this->builder->withTrashed();
        } elseif($select == 'trashed'){
            $this->builder->onlyTrashed();
        } else {
            $this->builder;
        }
    }

    public function inn(string $inn)
    {
        $this->builder->where('inn', $inn);
    }
}
