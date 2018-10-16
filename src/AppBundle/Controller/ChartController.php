<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Car;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChartController extends Controller
{

 /**
     * Attached to the data all the labels and titles required by the chart
     *
     * @param bool $interval
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function NumberPlatebyTypeChartAction($interval = false)
    {
        $statistics = $this->get('app.statistics_service');
        $data = $statistics->getNumberPlateByType($interval);
        
        $jsonData = [
            'data' => [
                'name' => "Cars",
                'data' => $data['values']
            ],
            'chartTitle' => 'Car by brand',
            'chartSubTitle' => '',
            'yAxisTitle' => 'Brand',
            'categories' => $data['categories'],
        ];
        
        return $this->render('bar_plate.html.twig', array(
            'data' => json_encode($jsonData),
        ));
    }
}