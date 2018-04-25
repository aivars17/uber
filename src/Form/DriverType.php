<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Repository\CarRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('license', TextType::class)
            ->add('age', IntegerType::class)
            ->add('cars', EntityType::class, [
            'class' => Car::class,
            'choice_label' => 'make',
            'multiple' => true,
            'required' => false,
            ])
            ->add('photo', FileType::class,[
                'required' => false,
            ]);
        if (!empty($filename)){
            $builder->get('photo')
                ->addModelTransformer(new CallbackTransformer(
                    function ($filename) {
                        if (isset($filename)){
                            // transform the array to a string
                            $path = $this->container->getParameter('attachment_folder').'/'. $filename;
                            return new File($path);
                        }
                    },
                    function (File $file) {
                        // transform the string back to an array

                        return $file;
                    }
                ))
            ;
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class
        ]);
    }
}
