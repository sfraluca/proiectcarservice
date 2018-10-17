<?php

namespace AppBundle\Repository;
use Lugera\StaaBundle\Entity\Vacancy;
use Lugera\StaaBundle\Service\StatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllByType($interval, $formated = true)
    {

       $query = $this->createQueryBuilder('c')
                ->select('count(c.brand) as nr, c.brand')
                ->groupBy('c.brand');

        $result = $query->orderBy('nr', 'DESC')->getQuery()->getResult();

        $max = 0;
        //get max of plateNumber array 
        if (!empty($result)) {
            $max = current(current($result));
        }
        $percentLimit = $max / 100;

        if (true === $formated) {
            $values = $categories = [];
            $others = 0;
            foreach ($result as $record) {
                if ((int) $record['nr'] >= $percentLimit) {
                    $values[] = (int) $record['nr'];
                    $categories[] = $record['brand'];
                } else {
                    $others = $others + (int) $record['nr'];
                }
            }

            if ($others > 0) {
                $categories[] = 'Other brands';
                $values[] = $others;
            }

            $return = [
                'values' => $values,
                'categories' => $categories,
            ];


            return $return;
        }

        return $result;
    }
}
