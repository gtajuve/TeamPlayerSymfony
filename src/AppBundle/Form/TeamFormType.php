<?php

namespace AppBundle\Form;

use AppBundle\Entity\Nation;
use AppBundle\Repository\NationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name")
                ->add("nation",EntityType::class,[
                    'placeholder' => "Select nationality",
                    'class' => Nation::class,
                    'query_builder' => (function(NationRepository $repo) {
                        return $repo->findAllAlpha();})
                         ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Team'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_team_form_type';
    }
}
