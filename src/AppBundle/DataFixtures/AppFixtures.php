<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;

class AppFixtures extends Fixture implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        {
            $user = new Entity\User();
            $user->setUsername('Maksim');
            $user->setUsernameCanonical('maksim');
            $user->setEmail('higher@ro.ru');
            $user->setEmailCanonical('higher@ro.ru');
            $user->setEnabled(1);
            $user->setPassword('$2y$13$MwrItHCxJxcgI0beGpazIu1RUK73/cvZAOBvZf7.azirEnU7siJhu');
            $user->setRoles([]);
            $user->setNickname('Румпельштиль');
            $manager->persist($user);
            $manager->flush();
        }
        {
            $player = new Entity\Player();
            $player->setUser($user);
            $player->setInGameId('1003878');
            $player->setCharacteristic('Лидер гильдии');
            $player->setEditor($user);
            $manager->persist($player);
            $manager->flush();

            $user->addPlayer($player);
            $manager->persist($user);
            $manager->flush();
        }
        {
            $playerLvl = new Entity\PlayerLvl();
            $playerLvl->setPlayer($player);
            $playerLvl->setLvl(92);
            $playerLvl->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $playerLvl->setEditor($user);
            $manager->persist($playerLvl);
            $manager->flush();
        }
        {
            $playerName = new Entity\PlayerName();
            $playerName->setPlayer($player);
            $playerName->setName('Kharkov');
            $playerName->setDate(\DateTime::createFromFormat('j M Y', '27 October 2018'));
            $playerName->setEditor($user);
            $manager->persist($playerName);
            $manager->flush();
        }
        {
            $playerName = new Entity\PlayerName();
            $playerName->setPlayer($player);
            $playerName->setName('Румпельштиль');
            $playerName->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $playerName->setEditor($user);
            $manager->persist($playerName);
            $manager->flush();
        }
        {
            $guild = new Entity\Guild();
            $guild->setName('Север');
            $guild->setShortName('PRM');
            $guild->setServer('S036');
            $guild->setEditor($user);
            $manager->persist($guild);
            $manager->flush();
        }
        {
            $playerGuild = new Entity\PlayerGuild();
            $playerGuild->setPlayer($player);
            $playerGuild->setGuild($guild);
            $playerGuild->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $playerGuild->setEditor($user);
            $manager->persist($playerGuild);
            $manager->flush();
        }
        {
            $champ = new Entity\Champ();
            $champ->setDate(\DateTime::createFromFormat('j M Y', '27 April 2019'));
            $champ->setComment('Мы продули хменам');
            $champ->setEditor($user);
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
