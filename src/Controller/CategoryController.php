<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function create(): Response
    {
        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     *@Route ("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository, Request $request )
    {
        $category = $categoryRepository->find($id);
          
        return $this->render('category/edit.html.twig', [
            'category' => $category,
        ]);
    }
}
