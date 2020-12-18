<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodayDateController extends AbstractController
{
    /**
     * @Route("/today/date", name="today_date")
     */

    public function date(){
        $date = date("d/m/Y");
        return new Response(
            '<html><body>Today is'.$date.'</body></html>'
        );
    }
   
}
