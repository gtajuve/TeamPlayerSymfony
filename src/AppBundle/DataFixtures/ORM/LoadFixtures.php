<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/8/17
 * Time: 12:14 AM
 */
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $objects=Fixtures::load(__DIR__.'/fixtures.yml',$manager,[
            'providers' => [$this]
        ]);
    }
    public function nation()
    {
        $genera = [
            'BUL',
            'GER',
            'ITA',
            'ENG',
            'SCO',
            'SPA',
            'POR',
            'NED',
            'BRA',
            'ARG',

        ];
        $key = array_rand($genera);
        return $genera[$key];
    }
    public function position()
    {
        $genera = [
            'GK',
            'DF',
            'MD',
            'AT',

        ];
        $key = array_rand($genera);
        return $genera[$key];
    }
}