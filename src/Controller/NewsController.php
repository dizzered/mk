<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @Route("/news/{slug}")
     */
    public function index($slug)
    {
    	/** @var NewsRepository $rep */
    	$rep = $this->getDoctrine()->getRepository(News::class);
    	$news = $rep->findBySlug($slug);
    	
        return $this->render('news/news.html.twig', [
            'news' => $news,
        ]);
    }
}
