<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MugType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Filll the name'
                ]
            ])
            ->add('stock', null, [
                'data' => 1
            ])
            ->add('enabled', ChoiceType::class, [
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'No' => 0,
                    'Yes' => 1
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}