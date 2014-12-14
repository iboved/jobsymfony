<?php

namespace Iboved\AdvertBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddAdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', new AddUserType())
            ->add('title')
            ->add('description')
            ->add('rubric', 'entity', [
                'class' => 'IbovedAdvertBundle:Rubric',
                'multiple' => false
            ])
            ->add('save', 'submit');
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iboved\AdvertBundle\Entity\Advert',
        ));
    }
    public function getName()
    {
        return 'addAdvert';
    }
}
