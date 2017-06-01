<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Controller\ApiAuthenticationController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class ApiAuthenticationSubscriber
 * @package AppBundle\EventSubscriber
 * @see http://symfony.com/doc/2.8/event_dispatcher/before_after_filters.html
 */
class ApiAuthenticationSubscriber implements EventSubscriberInterface
{
    public function onKernelController(FilterControllerEvent $event)
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
        // TODO: add the authentication logic
        if (false && $controller[0] instanceof ApiAuthenticationController) {
            throw new \Exception('finally worked!');
        }
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::CONTROLLER => 'onKernelController'];
    }
}