<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\AppProviders;
use App\Entity\Logiciel;
use App\Entity\Pictures;
use App\Entity\Project;
use App\Entity\Subproject;
use App\Entity\Tags;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    //le composant de symfony appel la fonction load grace a l"object manager 
    // cest l'injection de dependence. Dans symfony, le composant injecteur de service
    //fait les new objet pour nous lorsqu'il y aura une injection


    //!si je suis dans un controller on injecte la dependant directement 
    //!en argument de la fonction si on est dans un service on utilise un construct
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        // je suis dans une class et pas dans un controller donc je dois crée un 
        //construct pour injecter une class. 
        // initialisation de faker
        $faker = Factory::create("fr_FR");
        // j'ajoute mon provider custom
        $faker->addProvider(new AppProviders($faker));


        //// ! user //////////////////////////////////////////// 
        // TODO: voir si je met les tableaux dans les providers
        $user = [
            "users" => [ "sonia", "reader"],
            "email" => [ "sonia@gmail.com", "user@gmail.com", ],

        "password"=>[ "sonia","reader"] ];


        $userData = [ ['ROLE_ADMIN'], ['ROLE_READER'],];


        for ($j = 0; $j <= 1; $j++) {
        $admin = (new User)
        ->setEmail($user["email"][$j]);

        $password = $user["users"][$j];
        $hashpassword = $this->hasher->hashPassword($admin, $password);
        $admin->setPassword($hashpassword);

        $admin->setRoles($userData[$j]);
        $manager->persist($admin);
        }


        // ! project //////////////////////////////////////////// 
        $projects = [];
        for ($j = 0; $j <= 10; $j++) {

            $project = (new Project)
                ->setTitle($faker->unique()->getOneRamdonProject())
                ->setPicture($faker->imageUrl())
                ->setSummary($faker->paragraph(1))
                ->setStatus($faker->getOneRamdonStatus());

            if($project->getStatus() === 'Publié'){
                $project->setCreatedAt(new DateTimeImmutable($faker->date()));
            }
            $manager->persist($project);

            $projects[] = $project;
        }

        // ! tags //////////////////////////////////////////// 
        for ($i = 0; $i <= 5; $i++) {
            $tag = new Tags;
            $tag->setName($faker->unique()->getOneRamdonTag());
            
            // TODO:un projet doit avoit un tag
            $currentProject = $projects[$i];
            $tag->addProject($currentProject);

            $secondProject = $projects[array_rand($projects)];
            if (mt_rand(0, 1)) {
                if ($currentProject !== $secondProject) {
                    $tag->addProject($secondProject);
                }
            }

            $manager->persist($tag);
        }



        // ! subprojects //////////////////////////////////////////// 
        $subproject = [];

        for ($k = 0; $k <= 20; $k++) {
            $subprojects = new Subproject;
            $subprojects->setTitle('titre de sous projets');
            $subprojects->setSummary($faker->paragraph(1));
            $subprojects->setSubtitle('sous titre');
            $subprojects->setContent($faker->paragraph(1));

            //les clefs etrangere     
            $subprojects->setProject($projects[array_rand($projects)]);
            $subprojects->setStatus($faker->getOneRamdonStatus());

            $manager->persist($subprojects);
            $subproject[] = $subprojects;
        }

        // ! images //////////////////////////////////////////// 
        for ($z = 0; $z <= 40; $z++) {
            $images = new Pictures;
            $images->setSubproject($faker->imageUrl());
            $images->setProjectLogo($faker->imageUrl());


            $images->addPicture(($subproject[array_rand($subproject)]));


            $manager->persist($images);
        }

        // ! Logiciel //////////////////////////////////////////// 

        for ($m = 0; $m <= 20; $m++) {
            $logiciel = new Logiciel;
            // $logiciel->setName($outils[array_rand($outils)]);

            $logiciel->setName($faker->getOneRamdonLogiciel());

            $logiciel->addProject($projects[array_rand($projects)]);
            $logiciel->addSubproject($subproject[array_rand($subproject)]);

            $manager->persist($logiciel);
        }

        $manager->flush();
    }
}
