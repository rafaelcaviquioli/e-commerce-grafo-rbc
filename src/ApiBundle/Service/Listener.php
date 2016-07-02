<?php
namespace ApiBundle\Service;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class Listener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET');
    }
}