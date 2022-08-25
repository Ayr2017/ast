<?php

namespace App\Http\Livewire\Specialist\Report\Create;

use App\Models\Farm;
use App\Models\Form;
use App\Models\Organization;
use Livewire\Component;

class SelectOrganizationAndFarm extends Component
{
    /*
     * TODO::удалить весь компонент
     */
    public \Illuminate\Database\Eloquent\Collection $organizations;
    public mixed $farms;
    public mixed $forms;
    public mixed $organizationSearch = '';
    public mixed $farmSearch;
    public $organizationId = null;
    public $farmId = null;
    public int $formId;
    public bool $noFarms;

    public function __construct()
    {
        $this->organizations = Organization::all();
        $this->farms = $this->organizations?->first()?->farms;
        $this->forms = Form::all();
        $this->formId = $this->forms->first()->id;
        $this->noFarms = true;
    }

    public function mount()
    {
        $this->organizations = Organization::all();
        $this->forms = Form::all();
        $this->formId = $this->forms->first()->id;
        session()->put('form_id', $this->formId);
        $this->farms = $this->organizations?->first()?->farms;
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
        session()->put('form_id', $this->formId);
    }

    public function render()
    {
        return view('livewire.specialist.report.create.select-organization-and-farm');
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
