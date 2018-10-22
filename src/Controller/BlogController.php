<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistance\ObjectManager;
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
		$repo = $this->getDoctrine()->getRepository(Article::class);
		
		$articles = $repo->findAll();
		
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
			'articles' => $articles,
        ]);
    }
	
	/**
	 * @Route("/", name="home")
	 */
	public function home()
	{	
		return $this->render('blog/home.html.twig',
		[
			'title' => "Site propulsé par Symfony"
		]);
	}
	
	/**
	 * @Route("/blog/forum/", name="forum")
	 */
	
	public function forum()
	{	
		
		return $this->render('blog/forum.html.twig',
		[
			
		]);
	}
	/**
	 * @Route("/blog/contact", name="contact")
	 */
	public function contact()
	{	
		return $this->render('blog/contact.html.twig',
		[
			'title' => "Site propulsé par Symfony"
		]);

	}
	
	/**
	 * @Route("/blog/create", name="create")
	 */
	
	public function create(Request $request)
	{	
		dump($request);
		
		if($request->request->count() > 0) {
			$articles = new Article();
			$articles->setTitle($request->request->get('title'))
					->setContent($request->request->get('content'))
					->setImage($request->request->get('image'));
					
			
		}
		
		return $this->render('blog/create.html.twig');
		

	}
}
