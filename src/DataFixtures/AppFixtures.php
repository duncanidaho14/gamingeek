<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Jeuxvideo;
use App\Entity\Plateforme;
use App\Entity\Nationalite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();


        for ($us=0; $us < 20; $us++) { 
            $user = new User();

            $user->setEmail($faker->email())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setUsername($faker->name())
                ->setAvatar($faker->imageUrl())
                ->setIntroduction($faker->sentence(5))
                ->setDescription($faker->paragraph(3))
                ->setCompany($faker->company())
            ;

            $manager->persist($user);
        }

        for ($nat=0; $nat < 6; $nat++) { 
            $nationalite = new Nationalite();

            $nationalite->setLibelle($faker->countryCode())
            ;

            $manager->persist($nationalite);
        
        
        }

        for ($aut=0; $aut < 20; $aut++) { 
            $auteur = new Auteur();

            $auteur->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())
                    ->setNationalite($nationalite)
            ;

            $manager->persist($auteur);
        }

        for ($cat=0; $cat < 5; $cat++) { 
            $categorie = new Categorie();

            $categorie->setLibelle($faker->name())
            ;

            $manager->persist($categorie);
        }

        for ($plat=0; $plat < 5; $plat++) { 
            $plateforme = new Plateforme();

            $plateforme->setNom($faker->name());

            $manager->persist($plateforme);
        }

        for ($jeu=0; $jeu < 40; $jeu++) { 
            $jeuxvideo = new Jeuxvideo();

            $jeuxvideo->setNom($faker->name())
                    ->setPrix($faker->numberBetween(0, 100))
                    ->setCategorie($categorie)
                    ->setPlateforme($plateforme)
            ;

            $manager->persist($jeuxvideo);
        }

        $manager->flush();
    }
}
