<?php
namespace App\Http\Livewire\Specialist\Organizations\Create;

use App\Models\District;
use App\Models\Region;
use Livewire\Component;

class SelectRegionAndDistrict extends Component
{
    public $organization = null;
    public $regions = [];
    public $region;
    public $districts = [];
    public $district;
    public $regionSearch = '';
    public $districtSearch = '';
    public $regionId = null;
    public $districtId = null;
    public $farm = null;

    public function __construct()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();

    }

    public function mount($farm = null)
    {
        $this->farm = $farm;
        $this->regionSearch = $farm?->region->name;
        $this->regionId = $farm?->region_id;
        $this->districtSearch = $farm?->district->name;

    }

    public function hydrate()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
    }


    public function updatedRegionSearch()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
        $this->regionId = Region::where('name', $this->regionSearch)?->first()?->id;
        $this->districtSearch = '';
        $this->districtId = null;
        $this->getDistricts();
        if($this->regionId){
            $this->regions = [];
        }
    }

    public function updatedDistrictSearch()
    {
        $this->getDistricts();
        $this->districtId = District::where('name', $this->districtSearch)?->first()?->id;
        if($this->districtId){
            $this->districts = [];
        }
    }

    public function getDistricts()
    {
        $this->districts = District::where('region_id', $this->regionId)
            ->where('name', 'like', '%' . $this->districtSearch . '%')
            ->get();
    }
    public function render()
    {
        return view('livewire.specialist.organizations.create.select-region-and-district');
    }
}
