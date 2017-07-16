<?php

namespace AppBundle\Form;

use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Repository\GameRepository;
use AppBundle\Repository\PlayerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RosterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("game",EntityType::class,[
                    'placeholder' => "Select game",
                    'class' => Game::class,
                    'query_builder' => (function(GameRepository $repo) {
                        return $repo->findAllOrderByPlayedDateForForm();})
                ])
                ->add("player",EntityType::class,[
                    'placeholder' => "Select player",
                    'class' => Player::class,
                    'query_builder' => (function(PlayerRepository $repo) {
                        return $repo->findAllOrderByLastNameForForm();})
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\Roster'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_roster_form_type';
    }
}
