<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use symfony\Component\Form\Extension\Core\Type\TextType;
use symfony\Component\Form\Extension\Core\Type\TextareaType;
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
     * @Route("/blog/new", name="blog_create")
     */
    public function create(){

        $article = new Articles();
        $form = $this->createFormBuilder($article)
                    ->add('title')
                    ->add('content', TextType::class)
                    ->add('image', TextType::class)
                    ->getForm();

        return $this->render('blog/create.html.twig', [
                    'formArticle' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Articles $article){

        return $this->render('blog/show.html.twig',[
                            'article' => $article
        ]);
    }

}
