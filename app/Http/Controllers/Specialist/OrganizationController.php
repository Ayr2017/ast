<?php

namespace App\Http\Controllers\Specialist;

use App\Actions\Specialist\Organizations\StoreOrganisation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\Organizations\StoreOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $organizations = Organization::all();

        return view('specialist.organizations.index',[
            'organisations' => $organizations,
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
        $organization = $storeOrganisation->execute($request);
        return redirect()->route('specialist.organizations.show',['organization' => $organization]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
