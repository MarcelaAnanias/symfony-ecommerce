<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('image', FileType::class, [
                'label' => 'Product image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        "maxSize" =>"1024k",
                        "mimeTypes" =>[
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'maxSizeMessage' => 'The uploaded file is too large. The maximum allowed size is 1MB.',
                        'mimeTypesMessage'=> "The uploaded file must be an image in PNG, JPG or JPEG format."
                    ])
                ]
            ])
            ->add('subCategories', EntityType::class, [
                'class' => SubCategory::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
