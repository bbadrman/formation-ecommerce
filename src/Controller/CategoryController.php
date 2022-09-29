<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function create(Request $request, SluggerInterface $slluger, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            
            $category->setSlug(strtolower($slluger->slug($category->getName())));
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        $formCat = $form->createView();  

        return $this->render('category/create.html.twig', [
            'formCat' => $formCat
        ]);
    }

    /**
     *@Route ("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $categoryRepository,SluggerInterface $slluger, Request $request, EntityManagerInterface $em )
    {
        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
       
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $category->setSlug(strtolower($slluger->slug($category->getName())));
           $em->flush($category);

        return $this->redirectToRoute('home');
    }

         $formCat = $form->createView();

          
        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formCat' => $formCat
        ]);
    }
}
