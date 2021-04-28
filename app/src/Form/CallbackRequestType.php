<?php

namespace App\Form;

use App\Entity\CallbackRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CallbackRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'firstName',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'lastName',
                'required' => true,
            ])
            ->add('country', CountryType::class, [
                'label' => 'country',
                'required' => true,
            ])
            ->add('nationalPhoneNumber', TelType::class, [
                'label' => 'nationalPhoneNumber',
                'required' => true,
            ])
            ->add('internationalPhoneNumber', HiddenType::class, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CallbackRequest::class,
        ]);
    }
}
