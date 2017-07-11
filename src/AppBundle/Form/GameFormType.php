<?php

namespace AppBundle\Form;

use AppBundle\Entity\Team;
use AppBundle\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('playedAt', DateType::class, array(
            'widget' => 'choice',))
            ->add("homeTeam",EntityType::class,[
                'placeholder' => "Select team",
                'class' => Team::class,
                'query_builder' => (function(TeamRepository $repo) {
                    return $repo->findAllAlpha();})])
            ->add("awayTeam",EntityType::class,[
                'placeholder' => "Select team",
                'class' => Team::class,
                'query_builder' => (function(TeamRepository $repo) {
                    return $repo->findAllAlpha();})])
            ->add("score",null,['attr' => ['placeholder' => '0:0']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Game'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_game_form_type';
    }
}
