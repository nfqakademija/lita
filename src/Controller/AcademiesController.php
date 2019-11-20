<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Academy;

class AcademiesController extends AbstractController
{
    /**
     * Returns list of academies.
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/academy/{id}",
     *     name="academy",
     *     methods={"GET"}
     * )
     */
    public function getAcademies()
    {
        $academies = $this->getDoctrine()
            ->getRepository(Academy::class)
            ->findAll();

        if ($academies === null) {
            return new JsonResponse("We could not find any academies", Response::HTTP_NOT_FOUND);
        }

        $academiesArray = array();

        foreach ($academies as $academy) {
            $academiesArray[] = array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
            );
        }

        return new JsonResponse(
            $academiesArray,
            JsonResponse::HTTP_OK
        );
    }


    /**
     * Returns academy selected by the id.
     *
     * @param $id
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/academy/{id}",
     *     name="academy",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function getAcademy(int $id)
    {
        $academy = $this->getDoctrine()
            ->getRepository(Academy::class)
            ->find($id);

        if ($academy === null) {
            return new JsonResponse("There is no academy with id of: " . $id, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
            ),
            JsonResponse::HTTP_OK
        );
    }
}
