<?php
namespace App\Service\Action;

use App\Repository\AcademyRepository;
use App\Service\FilterService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramListAction
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var AcademyRepository
     */
    private $academyRepository;

    public function __construct(
        ContainerInterface $container,
        AcademyRepository $academyRepository
    ) {
        $this->container = $container;
        $this->academyRepository = $academyRepository;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function execute(Request $request): Response
    {
        $filterPrograms = new FilterService();

        $filtersData = $filterPrograms->execute($request);
        $programs = $this->academyRepository->filterPrograms($filtersData);
        $content = $this->container->get('twig')->render('home/filter.html.twig', [
            'programs' => $programs,
            'page'     => $request->get('page', 1),
        ]);

        $response = new Response();
        $response->setContent($content);

        return $response;
    }
}
