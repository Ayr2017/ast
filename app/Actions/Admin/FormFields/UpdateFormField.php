<?php

namespace App\Actions\Admin\FormFields;

use App\Models\FormField;

class UpdateFormField
{
    public function execute($validatedRequest, $id)
    {
        $formField = FormField::withTrashed()->find($id);
        $type = $validatedRequest->type;
        if($type != 'select' || $type != 'checkbox'|| $type != 'radio') {
            $validatedRequest['select_fields'] = null;
        }
        $formField->update($validatedRequest);
        return $formField;
    }
}
