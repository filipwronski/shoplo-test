<?php

namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProductType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('price', MoneyType::class, array( 'currency' => false, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('save', SubmitType::class, array('label' => 'Add Product', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')));
    }
}
