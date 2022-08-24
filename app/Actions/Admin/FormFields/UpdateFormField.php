<?php

namespace App\Actions\Admin\FormFields;

use App\Models\FormField;

class UpdateFormField
{
    public function execute($validatedRequest, $id)
    {
        $formField = FormField::withTrashed()->find($id);
        $formField->update($validatedRequest);
        return $formField;
    }
}
