<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\AppProvider;
use App\DataFixtures\Providers\AppProviders;
use App\Entity\ImageSubproject;
use App\Entity\Logiciel;
use App\Entity\Project;
use App\Entity\Subproject;
use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // initialisation de faker
        $faker = Factory::create("fr_FR");
        // j'ajoute mon provider custom
        $faker->addProvider(new AppProviders($faker));



        // ! project
        $projects = [];
        for ($j = 1; $j <= 6; $j++) {

            $project = (new Project)
                ->setTitle($faker->unique()->projecNameTitle())
                ->setPicture($faker->imageUrl())
                ->setSummary($faker->paragraph(1));

            $currentValue = $project->setHomeOrder(mt_rand(0,4));

            $manager->persist($project);

            $projects[] = $project;
        }

        // ! tags
        for ($i = 0; $i <= 5; $i++) {
            $tag = new Tags;
            $tag->setName($faker->unique()->tagTitle());

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



        // ! subprojects
        $subproject = [];

        for ($k = 1; $k <= 5; $k++) {
            $subprojects = new Subproject;
            $subprojects->setTitle('titre de sous projets');
            $subprojects->setSummary($faker->paragraph(1));
            $subprojects->setSubtitle('sous titre');
            $subprojects->setContent($faker->paragraph(1));


            //les clefs etrangere       
            $subprojects->setProject($projects[array_rand($projects)]);

            $manager->persist($subprojects);
            $subproject[] = $subprojects;
        }

        
        for($z=1; $z <=20; $z++){
            $images = new ImageSubproject;
            $images->setPicture($faker->imageUrl());
            $images->addImage(($subproject[array_rand($subproject)]));
            
             $manager->persist($images);

         }
                

        // ! Logiciel
        // $outils = [
        //     1 => 'photoshop',
        //     2 => 'illustrator',
        //     3 => 'After Effect',
        // ];

        for ($m = 1; $m <= 5; $m++) {
            $logiciel = new Logiciel;
            // $logiciel->setName($outils[array_rand($outils)]);

            $logiciel->setName($faker->unique()->logicielsTitle());

            $logiciel->addProject($projects[array_rand($projects)]);
            $logiciel->addSubproject($subproject[array_rand($subproject)]);

            $manager->persist($logiciel);
        }


        $manager->flush();
    }
}
