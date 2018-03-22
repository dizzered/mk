<?php
// src/Command/CreateNewsCommand.php
namespace App\Command;


use App\Entity\News;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateNewsCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			// the name of the command (the part after "bin/console")
			->setName('app:create-news')
			
			// the short description shown while running "php bin/console list"
			->setDescription('Creates a news.')
			
			// the full command description shown when running the command with
			// the "--help" option
			->setHelp('This command allows you to create a news...')
			
			// configure an argument
			->addArgument('title', InputArgument::REQUIRED, 'The title of the news.')
			
			->addArgument('text', InputArgument::REQUIRED, 'The text of the news.')
		;
	}
	
	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int|null|void
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// outputs multiple lines to the console (adding "\n" at the end of each line)
		$output->writeln([
			'News Creator',
			'============',
			'',
		]);
		
		/** @var EntityManager $entityManager */
		$entityManager = $this->getContainer()->get('doctrine')->getManager();
		
		$news = new News();
		$news->setTitle($input->getArgument('title'));
		$news->setText($input->getArgument('text'));
		$news->setCreated(date('Y-m-d H:i:s'));
		$news->setSlug($this->toAscii($input->getArgument('title')));
		
		$entityManager->persist($news);
		
		$entityManager->flush();
		
		// retrieve the argument value using getArgument()
		$output->writeln('Title: ' . $input->getArgument('title'));
		
		$output->writeln('Text: ' . $input->getArgument('text'));
	}


	private function toAscii($str, $replace=array(), $delimiter='-') {
		setlocale(LC_ALL, 'ru_RU.UTF8');
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		return $clean;
	}
}