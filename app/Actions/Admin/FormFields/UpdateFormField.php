<?php

namespace App\Actions\Admin\FormFields;

use App\Models\FormField;

class UpdateFormField
{
    public function execute($validatedRequest, $id)
    {
        $formField = FormField::withTrashed()->find($id);
        $type = $validatedRequest['type'];
        $formField->update($validatedRequest);
        if($type != 'select' || $type != 'checkbox'|| $type != 'radio') {
            $formField->select_fields = null;
            $formField->save();
        }
        return $formField;
    }
}
