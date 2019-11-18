<?php

namespace App\Controller;

use App\Entity\Contact;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{

    /**
     * @Route("/test/mail", name="test_mail")
     * @param \Swift_Mailer $mailer
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(\Swift_Mailer $mailer,LoggerInterface $logger)
    {
        $name = "Drin";

        $message = new \Swift_Message('Test email');
        $message->setFrom('admin@zetcode.com');
        $message->setTo('dfejzullahu07@gmail.com');
        $message->setBody(
            $this->renderView(
                'mailer/index.html.twig',
                ['name' => $name]
            ),
            'text/html'
        );

        $mailer->send($message);

        $logger->info('email sent');
        $this->addFlash('notice', 'Email sent');

        return $this->redirectToRoute('index_page');
    }

    /**
     * @Route("/contactus", name = "contact_us")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param LoggerInterface $logger
     * @return Response
     */

    public function contactUs(Request $request,\Swift_Mailer $mailer,LoggerInterface $logger)
    {

        $email = new Contact();


        $form = $this->createFormBuilder($email)
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control')))
            ->add('message', TextareaType::class, array(
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Send',
                'attr' => array('class' => 'btn btn-primary mt-5','style'=>'width:100%')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->getData();



            $message = new \Swift_Message('Email from Contact Us');
            $message->setFrom($email->getEmail());
            $message->setTo('dfejzullahu07@gmail.com');
            $message->setContentType($email->getMessage());

            $mailer->send($message);



            return $this->redirectToRoute('index_page');
        }

        return $this->render('mailer/index.html.twig', array(
            'form' => $form->createView()
        ));

    }
}
