<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Clients;
use App\Entity\Driver;
use App\Entity\Trip;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length', IntegerType::class)
            ->add('duration', IntegerType::class)
            ->add('cost', IntegerType::class)
            ->add('client', EntityType::class, [
                'choice_label' => 'name',
                'class' => Clients::class,
            ])
        ->add('driver' ,EntityType::class, [
                'class' => Driver::class,
                'placeholder' => '',
                'choice_label' => 'name',
            ])
        ->add('save', SubmitType::class)
        ;
        $formModifier = function (FormInterface $form, Driver $driver = null) {
            $positions = null === $driver ? array() : $driver->getCars();

            $form->add('car', EntityType::class, array(
                'class' => Car::class,
                'placeholder' => '',
                'choice_label' => 'make',
                'choices' => $positions,
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getDriver());
            }
        );

        $builder->get('driver')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $driver = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $driver);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
