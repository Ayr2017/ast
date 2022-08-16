<?php

namespace App\Actions\Specialist\Organizations;

use App\Http\Requests\Specialist\Organizations\StoreOrganizationRequest;
use App\Models\Organization;
use App\Services\DadataService;
use function App\Helpers\collectR;

class StoreOrganisation
{
    public function execute(StoreOrganizationRequest $request)
    {
        $validatedRequest = $request->validated();
        $dadataService = new DadataService();

        $organizationFromDadata = $dadataService->getOrganizationByInn($validatedRequest['inn']);

        $validatedRequest['kpp'] = $organizationFromDadata->get('data')?->get('kpp');
        $validatedRequest['ogrn'] = $organizationFromDadata->get('data')?->get('ogrn');
        $validatedRequest['data'] = $organizationFromDadata->get('data');
        $validatedRequest['creator_id'] = auth()->id();

        return Organization::firstOrCreate(['inn' => $validatedRequest['inn']],$validatedRequest);

    }
}
