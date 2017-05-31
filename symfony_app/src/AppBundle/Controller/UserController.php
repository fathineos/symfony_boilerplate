<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/user/{id}", name="user_index")
     * @return JsonResponse
     */
    public function indexAction(
        string $id
    ): JsonResponse {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        return new JsonResponse($user->getAttributes());
    }
}
