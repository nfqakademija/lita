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
    private $vehicleRepository;

    public function __construct(
        ContainerInterface $container,
        ProgramRepository $vehicleRepository
    ) {
        $this->container = $container;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function execute(Request $request): Response
    {
        $buildFilterDtoService = new FilterService();

        $filtersData = $buildFilterDtoService->execute($request);
        $vehicles = $this->vehicleRepository->filterPrograms($filtersData);
        $content = $this->container->get('twig')->render('program/filter.html.twig', [
            'programs' => $vehicles,
            'page' => $request->get('page', 1),
        ]);

        $response = new Response();
        $response->setContent($content);

        return $response;
    }
}
