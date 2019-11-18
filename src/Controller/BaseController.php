<?php

namespace App\Controller;


use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="index_page")
     */
    public function index(BlogRepository $blogRepository, Request $request): Response
    {
        $data = $blogRepository->returnData($request);
        $user = $this->getUser();
        return $this->render('base/index.html.twig', [
            'blogs' => $data /*$blogRepository->findAll()*/,
            'controller_name' => 'BaseController',
            'user' => $user,

        ]);
    }


}

