<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }



    /**
     * @Route("/twig-test", name="homepage-test")
     */
    public function twigtestAction(Request $request)
    {

        // Ici récup les tweets
//        $tweets = ....

        return $this->render(':default:index.html.twig', array(
            'name' => 'John DOE',
            'days' => array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'),
            'html' => '<b>Ce texte n\'est pas en gras !</b>',
            'date' => date('H:i:s d/m/Y'),
            )
        );
    }

}
