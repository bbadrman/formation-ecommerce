<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{



    /**
     * @Route("/hello/{nom}", name="hello")
     */

    public function hello($nom = 'world')
    {

        return $this->render('hello.html.twig', [
            'nom' => $nom,
            'formateur1' => ['prenom' => 'badr', 'nom' => 'bechtioui'],
            'formateur2' => ['prenom' => 'yassine', 'nom' => 'charafi'],

        ]);
    }

    /**
     * @Route("/example", name="example")
     */
    public function example()
    {
        return $this->render('example.html.twig', [
            'age' => 33
        ]);
    }

   
}
