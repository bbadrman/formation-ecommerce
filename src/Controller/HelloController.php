<?php

namespace App\Controller;

use App\Taxes\Calculator;
use App\Taxes\Detector;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HelloController
{

    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

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

    protected function render(string $path, array $variables = [])
    {
        $html = $this->twig->render($path, $variables);
        return new Response($html);
    }
}
