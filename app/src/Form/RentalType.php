<?php

namespace App\Form;

use App\Entity\Rental;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('describe')
            ->add('price')
            ->add('localisation')
            ->add('filename', FileType::class, [
                'label' => 'File (Image file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                                 'maxSize' => '2G',
                                 'mimeTypes' => [
                                     'image/jpeg',
                                     'image/png'
                                 ],
                                 'mimeTypesMessage' => 'Please upload a valid image file',
                             ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
}