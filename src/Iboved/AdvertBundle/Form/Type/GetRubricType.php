<?php

namespace Iboved\AdvertBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GetRubricType extends AbstractType
{
    protected $rubrics;

    public function __construct(array $rubrics)
    {
        $this->rubrics = $rubrics;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $rubrics = array();
        foreach ($this->rubrics->getRubric() as $key => $value) {
            $rubrics[$value->getId()] = $value->getName();
        }

        $builder
            ->add('name', 'choice', [
                'choices' => $rubrics
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iboved\AdvertBundle\Entity\Rubric',
        ));
    }
    public function getName()
    {
        return 'getRubric';
    }
}
