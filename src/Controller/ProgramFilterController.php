<?php
namespace App\Controller;

use App\Dto\FiltersData;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProgramFilterController extends AbstractController
{
    /**
     * @Route("program/filter", name="filter")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function filter(Request $request, SessionInterface $session)
    {
        $filtersData = new FiltersData();

        $filtersData->setProgramName($request->get('program_name'));
        $filtersData->setPage($request->get('page') ? $request->get('page') : 1);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->filterPrograms($filtersData);

        $totalPrograms = $this->getDoctrine()
            ->getRepository(Program::class)
            ->countMatchingPrograms($filtersData);

        $pagesCount = ceil($totalPrograms / $filtersData->getPageSize());

        $session->set('current_filters', $request->query->all());

        return $this->render('program/filter.html.twig', [
            'programs' => $programs,
            'pagesCount' => $pagesCount,
            'currentPage' => $request->get('page') ? $request->get('page') : 1,
            'currentFilters' => $request->query->all(),
        ]);
    }
}
