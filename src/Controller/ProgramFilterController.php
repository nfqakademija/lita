<?php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Service\Action\ProgramListAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProgramFilterController
 * @package App\Controller
 */
class ProgramFilterController extends AbstractController
{
    /** @var ProgramRepository */
    private $programRepository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    /**
     * @Route("/filter", name="filter")
     * @param Request $request
     * @param ProgramListAction $programListAction
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function filter(Request $request, ProgramListAction $programListAction): Response
    {
//        $filterPrograms = new FilterService();
//
//        $filtersData = $filterPrograms->execute($request);
//        $programs = $this->programRepository->filterPrograms($filtersData);
//        $content = $this->container->get('twig')->render('home/filter.html.twig', [
//            'programs' => $programs,
//            'page'     => $request->get('page', 1),
//        ]);
        return $programListAction->execute($request);
    }
}
