<?php

namespace App\Http\Livewire\User\Contacts;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateContact extends Component
{
    public string $model_type;
    public string $name;
    public string $type;
    public string $value;

    protected $rules = [
        'name' => 'required|string',
        'job_title' => 'required|string',
        'type' => 'required|in:email,phone,mobile',
        'value' => 'required|string',
        'model_type' => 'required|string|min:5',
        'model_id' => 'required|numeric',
    ];

    public function __construct($model_type)
    {
        $this->model_type = $model_type;
        $this->model_id = null;
        $this->name = '';
        $this->type = 'mobile';
        $this->value = '';
        $this->job_title = '';
    }

    public function mount()
    {
    }

    public function updated()
    {
    }


    public function render()
    {
        return view('livewire.user.contacts.create-contact');
    }

    public function save()
    {
        $contact = Contact::updateOrCreate([
            'model_type' => $this->model_type,
            'model_id' => $this->model_id,
            'value' => $this->value,
        ],[
            'model_type' => $this->model_type,
            'model_id' => $this->model_id,
            'name' => $this->name,
            'job_title' => $this->job_title,
            'type' => $this->type,
            'value' => $this->value,
        ]);
    }
}
