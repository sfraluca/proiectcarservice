<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Car;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\ImageType;
use GuzzleHttp\Client;

class CarController extends Controller
{
    
    /**
     * @Route("/car/", name="back")
     */
    public function carAction(Request $request) {
       
        $car = $this->getDoctrine()
                ->getRepository('AppBundle:Car')
                ->findAll();
   
        return $this->render('default/car.html.twig', array('Car' => $car));
        
    }

       /**
       * @Route("/car/add")
       */
     public function addServiceAction(Request $request)
    {
        $car = new Car();
        $car->setPlateNumber('');
        $car->setBrand('');
        $car->setModel('');
        $car->setYear('');
        $car->setColor('');
        $car->setType('');

        $form = $this->createFormBuilder($car)
            ->add('plateNumber', TextType::class, array('label'=> 'PlateNumber', 'attr'=>array('class' => 'form-control', 'style' => 'margin-top:5px;margin-bottom:5px;')))
            ->add('brand', TextType::class, array( 'label'=> 'Brand', 'attr'=>array('class' => 'form-control','style' => 'margin-top:5px;margin-bottom:5px;')))
            ->add('model', TextType::class, array( 'label'=> 'Model', 'attr'=>array('class' => 'form-control', 'style' => 'margin-top:5px;margin-bottom:5px;')))
            ->add('year', TextType::class, array( 'label'=> 'Year', 'attr'=>array('class' => 'form-control', 'style' => 'margin-top:5px;margin-bottom:5px;')))
            ->add('color', TextType::class, array( 'label'=> 'Color', 'attr'=>array('class' => 'form-control', 'style' => 'margin-top:5px;margin-bottom:5px;')))
            ->add('type', TextType::class, array( 'label'=> 'Type', 'attr'=>array('class' => 'form-control','style' => 'margin-top:5px;margin-bottom:5px;')))
            
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
        $plateNumber=$form['plateNumber']->getData();
        $brand=$form['brand']->getData();
        $model=$form['model']->getData();
        $year=$form['year']->getData();
        $color=$form['color']->getData();
        $type=$form['type']->getData();
        
        $car->setPlateNumber($plateNumber);
        $car->setBrand($brand);
        $car->setModel($model);
        $car->setYear($year);
        $car->setColor($color);
        $car->setType($type);
        
        $em=$this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return $this->redirectToRoute('back');
        }   
        return $this->render('default/addcar.html.twig', array('form' => $form->createView(),));
}
    /**
     * @Route("/")
     */
      public function uploadAction(Request $request)
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
      
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $image->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('web'),
                $fileName
            );
            $image->setImage($fileName);
                  
            $em=$this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
       
           return $this->redirectToRoute('check', array('imageId'=>$image->getId()));
        }
       
       $categorie = $this->getDoctrine()
                ->getRepository('AppBundle:Categorie')
                ->findAll();
       $categorieTitlu = $request->query->get('title', 'Preturi REVIZII');
       $produse = $this->getDoctrine()
                ->getRepository('AppBundle:Produse')
                ->findAllProduseByCategorie($categorieTitlu);
   
        return $this->render('default/upload.html.twig', array('Produse' => $produse, 'Categorie' => $categorie ,'form' => $form->createView()) );
        
    }
    
    
    
    /**
     * @Route("/car/check/{imageId}", name="check")
     */
    public function checkAction(Request $request)
    {
        $imageId =  $request->get('imageId');        
        $client = new \GuzzleHttp\Client();      
        $apiUrl = 'https://api.openalpr.com/v2/recognize?recognize_vehicle=0&country=eu&secret_key=sk_8b541c25e9b8b8051f8ba0f4';      
        $image =  $this->getDoctrine()
                            ->getRepository('AppBundle:Image')
                            ->find($imageId);
        $imageName = $image->getImage();
        $imagePath = 'C:\Users\Sferle Raluca\Documents\work\myprojects\proiectcarservice\web\uploads\images\\' .$imageName;
        $res = $client->request('POST', $apiUrl, [
            'multipart' => [
                    [
                    'name' => 'image',
                    'contents' => fopen($imagePath, 'r')
                    ]
                ]
            ]
        );
   
        $responseArray = json_decode($res->getBody(), true);
        $responseResultArray = $responseArray["results"][0];
        $plateNumber = $responseResultArray["plate"];
        $url = "/car/service/?nr=$plateNumber";
        return $this->redirect($url);
    }


 }
        
      
   