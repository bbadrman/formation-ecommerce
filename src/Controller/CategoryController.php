<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CategoryController extends AbstractController

{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function renderMenuList()
    {
        //1- aller chercher la category dans la base donées
        $categories = $this->categoryRepository->findAll();
        //2- renvoyer le rendu html sous la form response ($form->render)

        return $this->render('category/_menu.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function create(Request $request, SluggerInterface $slluger, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
     *@IsGranted("ROLE_ADMIN", message="Vous n'avez pas le droite d'access a cette options")
     */
    public function edit($id, CategoryRepository $categoryRepository, SluggerInterface $slluger, Request $request, EntityManagerInterface $em)
    {
       
       $this->denyAccessUnlessGranted("ROLE_ADMIN", null, "Vous n'avez pas le droite d'access a cette ressource");
        // $user = $this->getUser();
        
        // if ($user === null) {
        //     return $this->redirectToRoute('login_security');
        // }

        // if ($this->isGranted("ROLE_ADMIN") === false) {


        //     throw new AccessDeniedException("Vous n'avez pas le droite d'access a cette ressource");
        // }

        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
