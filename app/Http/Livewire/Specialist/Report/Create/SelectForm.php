<?php

namespace App\Http\Livewire\Specialist\Report\Create;

use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormCategory;
use App\Models\FormField;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;
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
    public mixed $formFieldsGroupedByCategory;
    /**
     * @var string[]
     */
    public array $colors;
    public $fieldCategories;

    public function __construct()
    {
        $this->formId = session()->get('form_id') ?? Form::first()?->id;
        $this->farmId = session()->get('farm_id') ?? null;

        $this->organizations = Organization::all();
        $this->forms = Form::all();
        $this->farms = Farm::with('organization')->get();
        $this->colors = FieldCategory::CATEGORY_COLORS;
        $this->fieldCategories = FieldCategory::all();


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
            $this->form = Form::with('fields.category')->find($this->formId) ?? collect([]);
//            $this->formFields = $this->form->fields?->groupBy('field_category_id')->collect();
            $this->formFieldsGroupedByCategory =
                FieldCategory::with(['fields' => fn($query) => $query->where('id', 'in', $this->form->fields->pluck('id'))])
                ->whereHas('fields', function($query){
                    return $query;
                })
                ->get()->load('fields');
        }
    }

    public function mount()
    {
    }

    public function hydrate()
    {
        $this->form = Form::with('fields.category')->find($this->formId) ?? collect([]);
        $this->formFields = FormField::where('form_id',$this->formId)->get()?->groupBy('field_category_id')->collect();

//        $this->organizations = Organization::where('name', 'like', '%'.$this->organizationSearch.'%')->get();
    }

    public function updatedOrganizationSearch($value)
    {
        $this->organizationSearch = $value;
        $this->organizations = Organization::where('name', 'like', '%'.$value.'%')->get();
        $this->organizationId = $this->organizations->first()->id;
        $this->farms = Farm::where('organization_id', $this->organizationId)->get();
        $this->farmSearch = '';
        $this->farmId = null;

    }

    public function updatedFormId($value)
    {
        $this->formFields = FormField::where('form_id',$value)->get()?->groupBy('field_category_id')->collect();
    }


    public function render()
    {
        return view('livewire.specialist.report.create.select-form');
    }


}
