<?php

namespace App\Actions\Specialist\Organizations;

use App\Models\Contact;

class UpdateContacts
{
    public function execute($validatedRequest, $organization)
    {
        $contact = new Contact();
        $validatedRequest['contact']['contactable_id'] = $organization->id;
//        dd($validatedRequest);
        $contact->fill($validatedRequest['contact']);
        dd($contact);
        $contact->organization()->associate($contact);
        $contact->save();

        return $contact;
    }
}
