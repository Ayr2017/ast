<?php

namespace App\Http\Controllers\General;

use App\Actions\General\Contacts\StoreContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Contacts\StoreContactRequest;
use App\Models\Contact;
use App\Models\Interfaces\Contactable;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $contactable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreContactRequest $request
     * @param StoreContact $storeContact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request, StoreContact $storeContact)
    {
        $validatedRequest = $request->validated();
        $contact = $storeContact->execute($validatedRequest);
        return redirect()->to(url()->previous());
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
        $contact = Contact::withTrashed()->find($id);
        return view('general.contacts.edit',['contact' => $contact]);
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->back();
    }
}
