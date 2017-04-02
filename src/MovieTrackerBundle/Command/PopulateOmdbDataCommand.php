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
        $movies = $entityManager->getRepository('MovieTracker:Movie')->findBy(array(), array('date' => 'ASC'));

        // this is now the first movie
        $movie = $movies[0];

        $client = new Client();

        foreach ($movies as $key => $movie) {
            $output->writeln(sprintf($movie->getTitle()));

            $response = $client->request('GET', 'http://www.omdbapi.com', array(
                'query' => array('t' => $movie->getTitle())
            ));

            $output->writeln($response->getBody()->getContents());

            $data = json_decode($response->getBody(), true);
            $output->writeln(sprintf('The movie title is %s', $data['Title']));
            $output->writeln(sprintf('The movie\'s director is %s', $data['Director']));
            $output->writeln(sprintf('Some actors in the movie are %s', $data['Actors']));
            if ($movie->getDirector() == null)
            {
                $output->writeln(sprintf('No director.'));
                $movie->setDirector($data['Director']);
            }
            else
            {
                $movie->setImdbId($data['imdbID']);
            }

        }

        $entityManager->flush();
    }
}
