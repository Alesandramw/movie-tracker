<?php

namespace MovieTrackerBundle\Command;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateOmdbDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('movietracker:populate')
            ->setDescription('Populate data for movies from OMDB.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        // get all of the movies in the database ordered by date ascending, so oldest first
        $movies = $entityManager->getRepository('MovieTracker:Movie')->findBy(array(), array('date' => 'DESC'));

        $client = new Client();

        foreach ($movies as $key => $movie) {
            if ($key > 10)
            {
                break;
            }

            $output->writeln(sprintf($movie->getTitle()));

            $response = $client->request('GET', 'http://www.omdbapi.com', array(
                'query' => array('i' => $movie->getImdbId())
            ));

            $output->writeln($response->getBody()->getContents());

            $data = json_decode($response->getBody(), true);
            if ($movie->getDirector() == null)
            {
                $movie->setDirector($data['Director']);
            }
            if ($movie->getTitle() == null)
            {
                $movie->setTitle($data['Title']);
            }
            if ($movie->getImdbId() == null)
            {
                $movie->setImdbId($data['imdbID']);
            }
            if ($movie->getPoster() == null)
            {
                $movie->setPoster($data['Poster']);
            }

        }

        $entityManager->flush();
    }
}
