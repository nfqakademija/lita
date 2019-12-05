<?php
namespace App\Service\Action;

use App\Repository\ProgramRepository;
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
     * @var ProgramRepository
     */
    private $programRepository;

    public function __construct(
        ContainerInterface $container,
        ProgramRepository $programRepository
    ) {
        $this->container = $container;
        $this->programRepository = $programRepository;
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
        $programs = $this->programRepository->filterPrograms($filtersData);
        $content = $this->container->get('twig')->render('home/filter.html.twig', [
            'programs' => $programs,
            'page'     => $request->get('page', 1),
        ]);

        $response = new Response();
        $response->setContent($content);

        return $response;
    }
}
