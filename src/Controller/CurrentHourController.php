<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/** 
*@Route("/controller")
*/
class CurrentHourController extends AbstractController
{
    /**
     * @Route("/{nom}")
     * @Route("/current/hour/{nom}", name="current_hour")
     */
    public function index(Request $request): Response
    {
        $nom = $request->get('nom');
        return $this->render('current_hour/index.html.twig', [
            'controller_name' => $nom ,
        ]);
    }
}
