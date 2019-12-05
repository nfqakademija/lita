<?php
namespace App\Service;

use App\Dto\FiltersData;
use Symfony\Component\HttpFoundation\Request;

class FilterService
{
    /**
     * @param Request $request
     * @return FiltersData
     */
    public function execute(Request $request): FiltersData
    {
        $filterData = new FiltersData();
        $filterData->setProgramName($request->get('type'));
        $filterData->setPage($request->get('page', 1));
        return $filterData;
    }
}
