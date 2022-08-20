<?php

namespace App\Actions\Specialist\Farm;

use App\Models\Farm;

class UpdateFarm
{
    public function execute($validatedRequest,$id)
    {
        $farm = Farm::find($id);
        $farm->update($validatedRequest);
        return $farm;
    }
}
