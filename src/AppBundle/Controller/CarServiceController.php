<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Car;
use AppBundle\Entity\CarService;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarServiceController extends Controller {

    /**
     * @Route("/car/service/")
     */
    public function showAction(Request $request) {

        $carPlateNumber = $request->query->get('nr', 'BH12NGT');

        $carServices = $this->getDoctrine()
                ->getRepository('AppBundle:CarService')
                ->findAllServicesByCarPlateNumber($carPlateNumber);
        return $this->render('default/carservice.html.twig', array('viewServices' => $carServices));


//        $car = $this->getDoctrine()
//                    ->getRepository('AppBundle:Car')
//                    ->findOneByPlateNumber($carPlateNumber);
//        $carServices = $car->getCarServices();       
//        $carServices = $this->getDoctrine()
//                            ->getRepository('AppBundle:CarService')
//                            ->findByCar($car);
//        dump($carServices);
//        exit;
//        $car = $car_serviceId->getCarService();
//        return new Response(
//          '<html><body> Service id: '
//          . ''.$car_service->getId().'<br> Title: '
//          . ''.$car_service->getTitle().'<br> Price '
//          . ''.$car_service->getPrice().'<br> Description: '
//          . ''.$car_service->getDescription().'<br> Service date'
//          . ''.$car_service->getServiceDate().'<br>'
//          . ' belongs to: '
//          . ''.$car->getPlateNumber().'</body></html>'
//          );
    }

    /**
     * @Route("/car/service/add/", name="service")
     */
    public function addServiceAction(Request $request) {

        $service = new CarService();
        $service->setTitle('Write a title');
        $service->setPrice('Write a price');
        $service->setDescription('Write a description');
        $service->setServiceDate(new \DateTime('today'));

        $form = $this->createFormBuilder($service)
                ->add('title', TextType::class)
                ->add('price', TextType::class)
                ->add('description', TextType::class)
                ->add('serviceDate', DateType::class)
                ->add('Submit', SubmitType::class, array('label' => 'Add Service'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Get car object
            $carPlateNumber = $request->query->get('nr', 'BH12NGT');
            $car = $this->getDoctrine()
                    ->getRepository('AppBundle:Car')
                    ->findOneByPlateNumber($carPlateNumber);
            
            // Read form data
            $title = $form['title']->getData();
            $price = $form['price']->getData();
            $description = $form['description']->getData();
            $serviceDate = $form['serviceDate']->getData();

            $service->setTitle($title);
            $service->setPrice($price);
            $service->setDescription($description);
            $service->setServiceDate($serviceDate);
            $service->setCar($car);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            
            return $this->redirectToRoute('back');
        }

        return $this->render('default/addservice.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
