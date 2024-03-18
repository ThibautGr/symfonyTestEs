<?php

namespace App\Form\EleasticSearch;

use App\Entity\Produit;
use App\Form\EleasticSearch\Data\SearchData;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', SearchType::class, ['required' => false])
            ->add('produit', EntityType::class, [ 'class' => Produit::class, 'required' => false])
            ->add('createdThisMonth', CheckboxType::class, ['required' => false])
            ->setMethod('GET')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
          [
              'allow_extra_fields' => true,
              'data_class' => SearchData::class,
              'csrf_protection' => false
          ]
        );
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}