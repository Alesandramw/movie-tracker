<?php

namespace MovieTrackerBundle\ORM\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="movie")
 */
class Movie
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(name="director", type="string", length=255, nullable=true)
     */
    private $director;

    /**
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="thoughts", type="text", length=65535, nullable=true)
     */
    private $thoughts;

    /**
    * @ORM\Column(name="imdbId", type="string", length=255, nullable=true)
    */
    private $imdbId;

    /**
    * @ORM\Column(name="poster", type="string", length=255, nullable=true)
    */
    private $poster;

    /**
    * @ORM\Column(name="favorite", type="boolean", nullable=true)
    */
    private $favorite;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set director
     *
     * @param string $director
     *
     * @return Movie
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Movie
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Movie
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set thoughts
     *
     * @param string $thoughts
     *
     * @return Movie
     */
    public function setThoughts($thoughts)
    {
        $this->thoughts = $thoughts;

        return $this;
    }

    /**
     * Get thoughts
     *
     * @return string
     */
    public function getThoughts()
    {
        return $this->thoughts;
    }

    /**
     * Get an array of all valid movie ratings.
     *
     * @return array
     */
    public static function getValidRatings()
    {
        $ratings = array();

        for ($i = 1; $i <= 5; $i += 1)
        {
            $ratings[] = $i;
        }

        return $ratings;
    }

    /**
     * Set imdbId
     *
     * @param string $imdbId
     *
     * @return Movie
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * Get imdbId
     *
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * Set poster
     *
     * @param string $poster
     *
     * @return Movie
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set favorite
     *
     * @param boolean $favorite
     *
     * @return Movie
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * Get favorite
     *
     * @return boolean
     */
    public function getFavorite()
    {
        return $this->favorite;
    }
}
