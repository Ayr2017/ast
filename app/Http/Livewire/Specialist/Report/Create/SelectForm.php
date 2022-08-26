<?php

namespace App\Http\Livewire\Specialist\Report\Create;

use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormCategory;
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
    /**
     * @var string[]
     */
    public array $colors;
    public $fieldCategories;

    public function __construct($fieldCategories)
    {
        $this->formId = session()->get('form_id') ?? Form::first()->id;
        $this->farmId = session()->get('farm_id') ?? null;
        $this->organizations = Organization::all();
        $this->forms = Form::all();
        $this->farms = Farm::with('organization')->get();
        $this->colors = FieldCategory::CATEGORY_COLORS;

        $this->fieldCategories = $fieldCategories;


        if(!$this->farmId){
            $this->farm = Farm::with('organization')->first();
            $this->farmId = $this->farm->id;
        } else {
            $this->farm = Farm::with('organization')->find($this->farmId);
        }

        $this->organization = $this->farm->organization;
        $this->organizationId = $this->organization->id;

        $this->organizationSearch = $this->organization->name;
        $this->farmSearch = $this->farm->name;

        if($this->formId){
            $this->form = Form::with('fields.category')->find($this->formId) ?? null;
            $this->formFields = collect($this->form->fields?->groupBy('field_category_id'));
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
        $this->form = Form::with(['fields.category'])->find($this->formId);
        $this->formFields = collect($this->form?->fields?->groupBy('field_category_id')) ?? [];
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
