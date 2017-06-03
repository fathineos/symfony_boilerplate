<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Controller\ApiAuthenticationControllerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;

/**
 * @see http://symfony.com/doc/2.8/event_dispatcher/before_after_filters.html
 */
class ApiAuthenticationSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onKernelController(FilterControllerEvent $event): void
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }
        if ($controller[0] instanceof ApiAuthenticationControllerInterface) {
            $userId = $event->getRequest()->get('id');
            $apiKey = $event->getRequest()->get('api_key');
            if (!$userId || !$apiKey) {
                throw new InvalidArgumentsException;
            }

            $user = $this->em->getRepository(User::class)
                ->findBy(['id' => $userId, 'apiKey' => $apiKey]);
            if (!$user) {
                throw new UserTokenMissmatchException;
            }
        }
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $response = new JsonResponse(
            ['error_description' => $event->getException()->getMessage()],
            401
        );
        $event->setResponse($response);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::CONTROLLER => 'onKernelController'];
    }

}

class ApiAuthenticationException extends \Exception {}

class UserTokenMissmatchException extends ApiAuthenticationException
{
    protected $message = 'User Token Missmatch';
}

class InvalidArgumentsException extends ApiAuthenticationException
{
    protected $message = 'Access Token Missmatch';
}
