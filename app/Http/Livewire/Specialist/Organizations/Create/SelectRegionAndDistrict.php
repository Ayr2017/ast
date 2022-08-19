<?php

namespace App\Http\Livewire\Specialist\Organizations\Create;

use App\Models\District;
use App\Models\Region;
use Livewire\Component;

class SelectRegionAndDistrict extends Component
{
    public $organization = null;
    public $regions;
    public $region;
    public $districts;
    public $district;
    public $regionVisibility = false;
    public $districtVisibility = false;
    public $regionSearch = '';
    public $districtSearch = '';

    public function __construct()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
        $this->region = $this->regions->first();

        $this->districts = $this->region->districts;
        $this->district = $this->districts->first();
    }

    public function hydrate()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
    }


    public function updatedRegionSearch()
    {
        $this->regions = Region::where('name', 'like', '%' . $this->regionSearch . '%')->get();
        $this->regionVisibility = true;
        $this->getDistricts(true);
    }

    public function updatedDistrictSearch()
    {
        $this->getDistricts(false);
    }

    public function render()
    {
        return view('livewire.specialist.organizations.create.select-region-and-district');
    }

    public function selectRegion(Region $region)
    {
        $this->region = $region;
        $this->regions = collect([$region]);
        $this->regionSearch = $region->name;
        $this->regionVisibility = false;
        $this->districtSearch = '';
        $this->getDistricts(true);
    }

    public function selectDistrict(District $district)
    {
        $this->district = $district;
        $this->districts = collect([$district]);
        $this->districtSearch = $district->name;
        $this->getDistricts(false);
    }

    public function getDistricts($flag)
    {
        $this->districts = District::where('region_id', $this->region->id)
            ->where('name', 'like', '%' . $this->districtSearch . '%')
            ->get();
        $this->districtVisibility = $flag;


    }


}
