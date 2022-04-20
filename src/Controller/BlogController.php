<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;

use Doctrine\ORM\EntityManagerInterface;

use symfony\Component\Form\Extension\Core\Type\TextType;
use symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\form\ArticleType;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="app_blog")
     */
    public function index(ArticlesRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig',[
                            'age' => 19
        ]);
    }
    /**

     * @Route("/blog/article/12", name="blog_show")
     */
    public function show(){
        return $this->render('blog/show.html.twig');

    }

}
