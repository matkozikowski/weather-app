<?php

declare(strict_types=1);

namespace App\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, [
                'required' => true,
            ])
            ->add('country', TextType::class, [
                'required' => true,
            ])
            ->add('search', SubmitType::class);
    }
}
