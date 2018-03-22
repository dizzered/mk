<?php
namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
	/**
	 * @Route("/")
	 */
	public function index()
	{
		/** @var NewsRepository $rep */
		$rep = $this->getDoctrine()->getRepository(News::class);
		$news = $rep->findDescendant();
		
		return $this->render('news/index.html.twig', [
			'news' => $news,
		]);
	}
}