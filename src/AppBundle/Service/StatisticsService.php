<?php


namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
/**
*
* this service is providing processed data packed for using as statistics
* (mostly in charts)
*/
class StatisticsService {
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
    * returns vacancies distributed by their source, from they were retrieved
    * @return array data for chart
    */
    public function getNumberPlateByType($interval = false)
    {
        
        $plate = $this->container->get('doctrine')
        ->getRepository('AppBundle:Car')
        ->getAllByType($interval);
    
        return $plate;
    }
}