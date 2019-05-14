<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements ORMFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        {
            $user = new Entity\User();
            $user->setUsername('Maksim');
            $user->setUsernameCanonical('maksim');
            $user->setEmail('higher@ro.ru');
            $user->setEmailCanonical('higher@ro.ru');
            $user->setEnabled(1);
            $user->setPassword($this->encoder->encodePassword($user, 'higher@ro.ru'));
            $user->setRoles(['ROLE_SUPER_ADMIN']);
            $user->setNickname('Румпельштиль');
            $manager->persist($user);
            $manager->flush();
        }
        {
            $player = new Entity\Player();
            $player->setUser($user);
            $player->setInGameId('1003878');
            $player->setCharacteristic('Глава гильдии');
            $player->setEditor($user);
            $player->setName('Румпельштиль');
            $player->setLvl(95);

            $manager->persist($player);
            $manager->flush();

            $user->addPlayer($player);
            $manager->persist($user);
            $manager->flush();
        }
        {
            $guild = new Entity\Guild();
            $guild->setName('');
            $guild->setShortName('');
            $guild->setServer('');
            $manager->persist($guild);
            $manager->flush();
        }
        {
            $guild = new Entity\Guild();
            $guild->setName('Север');
            $guild->setShortName('PRM');
            $guild->setServer('S036');
            $guild->setEditor($user);
            $guild->addPlayer($player);
            $manager->persist($guild);
            $manager->flush();
        }
        {
            $champ = new Entity\Champ();
            $champ->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $champ->setComment('Мы продули хменам');
            $champ->setEditor($user);
            $champ->setType('all');
            $manager->persist($champ);
            $manager->flush();
        }
        {
            $playerChamp = new Entity\PlayerChamp();
            $playerChamp->setPlayer($player);
            $playerChamp->setChamp($champ);
            $playerChamp->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $playerChamp->setEditor($user);
            $manager->persist($playerChamp);
            $manager->flush();
        }
        {
            $guildChamp = new Entity\GuildChamp();
            $guildChamp->setGuild($guild);
            $guildChamp->setChamp($champ);
            $guildChamp->setPlace(2);
            $guildChamp->setEditor($user);
            $manager->persist($guildChamp);
            $manager->flush();
        }
    }
}
