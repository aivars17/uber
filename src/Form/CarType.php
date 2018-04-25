<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Repository\DriverRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make', TextType::class)
            ->add('model', TextType::class)
            ->add('type', ChoiceType::class, ['choices' => [
                'Petrol' => 0,
                'Diesel' => 1,
                'Gas' => 2]])
            ->add('driver', EntityType::class, [
                'class' => Driver::class,
                'choice_label' => 'name',
                'multiple' => true,
                'by_reference' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
