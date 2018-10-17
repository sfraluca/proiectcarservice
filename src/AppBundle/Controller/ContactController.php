<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
 
use AppBundle\Entity\Contact;

class ContactController extends Controller
 
{
    // /**
    // * @Route("/form", name="form")
    // */
 
//   public function contactAction(Request $request)
//    {
//         $contact = new Contact;     
 
//      # Add form fields
//        $form = $this->createFormBuilder($contact)
//        ->add('name', TextType::class, array('label'=> 'Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
//        ->add('email', TextType::class, array('label'=> 'Email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
//        ->add('subject', TextType::class, array('label'=> 'Subject','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
//        ->add('message', TextareaType::class, array('label'=> 'Message','attr' => array('class' => 'form-control')))
//        ->add('Save', SubmitType::class, array('label'=> 'Submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px; background-color: #af4c4c;')))
//        ->getForm();
 
//      # Handle form response
//        $form->handleRequest($request);
 
    
//     # check if form is submitted 
 
//        if($form->isSubmitted() &&  $form->isValid()){
//            $name = $form['name']->getData();
//            $email = $form['email']->getData();
//            $subject = $form['subject']->getData();
//            $message = $form['message']->getData(); 
 
//      # set form data   
 
//            $contact->setName($name);
//            $contact->setEmail($email);          
//            $contact->setSubject($subject);     
//            $contact->setMessage($message);                
 
//       # finally add data in database
 
//            $sn = $this->getDoctrine()->getManager();      
//            $sn -> persist($contact);
//            $sn -> flush();
           
//            $message = \Swift_Message::newInstance()

//                            ->setSubject($subject)
//                            ->setFrom('raluca.sferle@gmail.com')
//                            ->setTo($email)
//                            ->setBody($this->render('default/sendemail.html.twig',array('name' => $name)),'text/html');

//             $this->get('mailer')->send($message);
      
//         }   
 
        
  
//     return $this->render('default/contact.html.twig', array('form' => $form->createView()));

//     }

}