<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\User;

class UserController extends Controller implements ApiAuthenticationController
{
    /**
     * @Route("/user/{id}", name="user_index")
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function indexAction(
        Request $request,
        string $id
    ): JsonResponse
    {
        $apiKey = $request->get('api_key');
        if (!$apiKey) {
            return $this->errorResponse('Api key not provided', 400);
        }
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class)
            ->find($id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }
        return new JsonResponse($user->getAttributes());
    }

    /**
     * @param string $error the error description
     * @param int $code the error code
     * @return JsonResponse
     */
    private function errorResponse(string $error, int $code): JsonResponse
    {
        return new JsonResponse(['error_description' => $error], $code);
    }
}
