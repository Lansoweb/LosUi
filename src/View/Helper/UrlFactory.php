<?php

namespace LosUi\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UrlFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $sl)
    {
        $serviceLocator = $sl->getServiceLocator();
        $application = $serviceLocator->get('Application');

        return new Url($application->getRequest());
    }
}
