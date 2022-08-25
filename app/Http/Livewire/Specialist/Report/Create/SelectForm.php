<?php

namespace App\Http\Livewire\Specialist\Report\Create;

use App\Models\Farm;
use App\Models\Form;
use App\Models\Organization;
use Livewire\Component;

class SelectForm extends Component
{
    public mixed $formId;
    public mixed $farmId;
    public mixed $organizationId = null;
    public mixed $form;
    public mixed $organization = null;
    public mixed $farm;
    public mixed $organizations;
    public bool  $noFarms = false;

    public string  $organizationSearch = '';
    public string  $farmSearch = '';

    public mixed $farms;
    public mixed $forms;

    public mixed $formFields;

    public function __construct()
    {
        $this->formId = session()->get('form_id') ?? null;
        $this->farmId = session()->get('farm_id') ?? null;
        $this->organizations = Organization::all();
        $this->forms = Form::all();

        if($this->farmId){
            $this->farm = Farm::find($this->farmId) ?? null;
            $this->organization = $this->farm->organization;
            $this->organizationId = $this->organization?->id;
            $this->farms = $this->organization->farms;
        } else {
            $this->farms = $this->organization?->farms;
        }
        if($this->formId){
            $this->form = Form::find($this->formId) ?? null;
            $this->formFields = $this->form?->fields ?? [];
        }
    }

    public function mount()
    {
        $this->farm = Farm::find($this->farmId) ?? null;
        $this->form = Form::find($this->formId) ?? null;
        $this->organization = $this->form?->organization?->id;
    }

    public function render()
    {
        return view('livewire.specialist.report.create.select-form');
    }

    public function hydrate()
    {
        $this->organizations = Organization::where('name', 'like', '%' . $this->organizationSearch . '%')->get();
    }

    public function updatedOrganizationSearch()
    {
        $this->organizations = Organization::with('farms')->where('name', 'like', '%' . $this->organizationSearch . '%')->get();
        $this->organizationId = Organization::where('name', $this->organizationSearch)?->first()?->id;
        $this->farmSearch = '';
        $this->farmId = null;
        $this->getFarms();
    }

    public function updatedFarmSearch()
    {
        $this->farmId = Farm::where('name', $this->farmSearch)?->first()?->id;
        $this->getFarms();
        session()->put('farm_id', $this->farmId);
    }

    public function updatedFormId()
    {
        $this->form = Form::find($this->formId);
        $this->formFields = $this->form?->fields ?? [];
    }

    private function getFarms()
    {
        $this->farms = Farm::where('region_id', $this->organizationId)
            ->where('name', 'like', '%' . $this->farmSearch . '%')
            ->get();

        if(!$this->farms?->count()) {
            $this->farmSearch = 'Не найдено ферм у данной организации';
            $this->noFarms = true;
            session()->remove('farm_id');
        } else {
            $this->noFarms = false;
        }
    }
}
