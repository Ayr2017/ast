<?php

namespace App\Http\Livewire\User\Contacts;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateContact extends Component
{
    public Contact $contact;

    protected $rules = [
        'contact.name' => 'required|string',
        'contact.job_title' => 'required|string',
        'contact.type' => 'required|in:email,phone,mobile',
        'contact.value' => 'required|string',
        'contact.model_type' => 'required|string',
    ];

    public function __construct()
    {
        $this->contact = new Contact();
//        $this->contact->model = $model;
    }

    public function updatedContact()
    {
//        dd($this->contact);
    }

    public function render()
    {
        return view('livewire.user.contacts.create-contact');
    }

    public function save()
    {
        try {
        $contact = $this->contact->save();

        }catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
        if($contact){
            return redirect()->back();
        } else {

        }
    }
}
