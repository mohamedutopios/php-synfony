<?php

namespace App\EventSubscriber;

use App\Event\CustomEvent;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseEventSubscriber implements EventSubscriberInterface {
    
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
            KernelEvents::REQUEST => 'onKernelRequest',
            CustomEvent::STARTEVENT => 'onStartEvent'
        ];
    }

    public function onKernelResponse(ResponseEvent $event) 
    {
        $response = $event->getResponse();
        $response->headers->set("CUSTOM-HEADER", "VALUE OF CUSTOM HEADER");
    }

    public function onKernelRequest(RequestEvent $event) 
    {
        if(empty($event->getRequest()->get('token'))) {
            throw new Exception("Access Not Allowed");
        }
    }


    public function onStartEvent() 
    {
        
    }
}