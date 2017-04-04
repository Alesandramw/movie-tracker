<?php

namespace MovieTrackerBundle\Form\Type;

use MovieTrackerBundle\Form\Extension\Type\DeleteType;
use MovieTrackerBundle\ORM\Model\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $movie = $builder->getData();
        $builder
            ->add(
                'title',
                TextType::class,
                array(
                    'label' => 'Title',
                    'required' => true
                )
            )
            ->add(
                'director',
                TextType::class,
                array(
                    'label' => 'Director',
                    'required' => false
                )
            )
            ->add(
                'rating',
                ChoiceType::class,
                array(
                    'choices' => Movie::getValidRatings(),
                    'choice_label' => function($value) {
                        return $value;
                    }
                )
            )
            ->add(
                'date',
                DateType::class,
                array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'

                )
            )
            ->add(
                'thoughts',
                TextareaType::class,
                array(
                    'required' => false
                )
            )
            ->add(
                'imdbId',
                TextType::class,
                array(
                    'required' => false,
                    'label' => 'IMDB ID'
                    )
                )
            ->add(
                'poster',
                TextType::class,
                array(
                    'required' => false,
                    'label' => 'Poster'
                    )
                )
            ->add(
                'favorite',
                TextType::class,
                array(
                    'required' => false,
                    'label' => 'Favorite'
                    )
                )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => $movie->getId() ? 'Save Changes' : 'Add Movie'
                )
            )
        ;
         if ($movie->getId()) {

            $builder->add(
                'delete',
                DeleteType::class,
                array(
                    'confirmation' => true,
                    'confirmation_message' => 'Are you sure you would like to delete this movie?',
                    'label' => 'Delete'
                )
            );

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MovieTrackerBundle\ORM\Model\Movie'
        ));
    }
}
