<?php

namespace App\Http\Livewire\Specialist\Report\Create;

use App\Models\Farm;
use App\Models\Organization;
use Livewire\Component;

class SelectOrganizationAndFarm extends Component
{
    public \Illuminate\Database\Eloquent\Collection $organizations;
    public mixed $farms;
    public mixed $organizationSearch = '';
    public mixed $farmSearch;
    public $organizationId = null;
    public $farmId = null;

    public function __construct()
    {
        $this->organizations = Organization::all();
        $this->farms = $this->organizations?->first()?->farms;

    }

    public function mount()
    {
        $this->organizations = Organization::all();
        $this->farms = $this->organizations?->first()?->farms;
//        $this->organizationId = 0;
//        $this->farmId = 0;
    }

    public function hydrate()
    {
        $this->organizations = Organization::where('name', 'like', '%' . $this->organizationSearch . '%')->get();
    }

    public function updatedOrganizationSearch()
    {
        $this->organizations = Organization::where('name', 'like', '%' . $this->organizationSearch . '%')->get();
        $this->organizationId = Organization::where('name', $this->organizationSearch)?->first()?->id;
        $this->farmSearch = '';
        $this->getFarms();
    }

    public function updatedFarmSearch()
    {
        $this->getFarms();
        $this->farmId = Farm::where('name', $this->farmSearch)?->first()?->id;

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
    }
}
