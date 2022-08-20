<?php

namespace App\Http\Controllers\Specialist;

use App\Actions\Specialist\Organizations\StoreOrganisation;
use App\Actions\Specialist\Organizations\UpdateContacts;
use App\Actions\Specialist\Organizations\UpdateOrganization;
use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\Organizations\StoreOrganizationRequest;
use App\Http\Requests\Specialist\Organizations\UpdateOrganizationRequest;
use App\Models\Contact;
use App\Models\Organization;
use App\Services\DadataService;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $organizations = Organization::all();

        return view('specialist.organizations.index',[
            'organizations' => $organizations,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('specialist.organizations.create');
    }

    /**
     * @param StoreOrganizationRequest $request
     * @param StoreOrganisation $storeOrganisation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrganizationRequest $request, StoreOrganisation $storeOrganisation)
    {
        $validatedRequest = $request->validated();
        $dadataService = new DadataService();

        $organizationFromDadata = $dadataService->getOrganizationByInn($validatedRequest['inn']);

        if(!$organizationFromDadata){
            return redirect()->back()->withErrors(['message'=>'Организации с таким ИНН не существует.'])->withInput();
        }

        $organization = $storeOrganisation->execute($validatedRequest, $organizationFromDadata);

        return redirect()->route('specialist.organizations.show',['organization' => $organization]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $organization = Organization::with(['region', 'district', 'creator', 'farms','farms.district', 'farms.region'])->find($id);
        return view('specialist.organizations.show', ['organization' => $organization]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, $organizationId, UpdateOrganization $updateOrganization, UpdateContacts $updateContacts )
    {
        $validatedRequest = $request->validated();
        $organization = Organization::with('contacts')->find($organizationId);


        $updateOrganization->execute($validatedRequest, $organization);
        $updateContacts->execute($validatedRequest, $organization);

        dd($organization);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
