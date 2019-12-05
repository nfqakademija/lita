<?php
namespace App\Controller;

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
    /**
     * @Route("program/filter", name="filter")
     * @param Request $request
     * @param ProgramListAction $programListAction
     * @return Response
     */
    public function filter(Request $request, ProgramListAction $programListAction): Response
    {
        return $programListAction->execute($request);
    }
}
