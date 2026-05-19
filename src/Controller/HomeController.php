<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Photo;
use App\Repository\CategoryRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        PhotoRepository $photoRepository,
        CategoryRepository $categoryRepository
    ): Response {
          

        return $this->render('home/index.html.twig', [
            'photos' => $photoRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/photo/{id}', name: 'photo_show')]
    public function show(Photo $photo): Response
    {
        return $this->render('home/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category')]
    public function byCategory(
        Category $category,
        PhotoRepository $photoRepository,
        CategoryRepository $categoryRepository
    ): Response {


  
        return $this->render('home/index.html.twig', [
            'photos' => $photoRepository->findBy([
                'category' => $category
            ]),
            'categories' => $categoryRepository->findAll(),
            'activeCategory' => $category->getId()
        ]);
    }
}