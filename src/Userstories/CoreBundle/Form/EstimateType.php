<?php

namespace Userstories\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstimateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estimatedtime')
            ->add('user')
            ->add('story')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Userstories\CoreBundle\Entity\Estimate'
        ));
    }

    public function getName()
    {
        return 'userstories_corebundle_estimatetype';
    }
}
