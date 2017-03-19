<?php

namespace MovieTrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
                    'required' => true
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MovieTrackerBundle\ORM\Model\Movie'
        ));
    }
}
