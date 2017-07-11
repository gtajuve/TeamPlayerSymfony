<?php

namespace AppBundle\Form;

use AppBundle\Entity\Nation;
use AppBundle\Entity\Team;
use AppBundle\Repository\NationRepository;
use AppBundle\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("firstName")
                ->add("lastName")
                ->add("number")
                ->add("position",ChoiceType::class, array(
                    'choices'  => array(
                        'Вратар' => "GK",
                        'Защитник' => "DF",
                        'Полузащитник' => "MD",
                        'Нападател' => "AT",
                    )))
                ->add("nation",EntityType::class,[
                    'placeholder' => "Select nationality",
                    'class' => Nation::class,
                    'query_builder' => (function(NationRepository $repo) {
                        return $repo->findAllAlpha();})
                ])
                ->add("team",EntityType::class,[
                    'placeholder' => "Select team",
                    'class' => Team::class,
                    'query_builder' => (function(TeamRepository $repo) {
                        return $repo->findAllAlpha();})
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Player'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_player_form_type';
    }
}
