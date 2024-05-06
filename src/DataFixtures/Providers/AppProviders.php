<?php

namespace App\DataFixtures\Providers;

class AppProviders
{
    private $logiciels = [
        'Photoshop',
        'After Effect',
        'Illustrator',
        'Indesign',
        'Wordpress',
        'Prestashop',

    ];

    private $tag = [
        'édition',
        'motion design',
        'Animation logo',
        'Jiggle pub',
        'Animation jT',
        'Synthétisant',
        'Générique',
        'Gestion Réseaux sociaux',
        'Identité / Branding',
        'Édition',
        'Retouche photo',
        'Packaging',
        'Infographie',
        'Activation/Campagne/Event',
        'Stratégie de marque et conseil',
        'Création site Internet'
    ];

    private $projectName = [
        'C-Inertia',
        'Independence Burger',
        'Fonds de Dotation Zidane',
        'Complexe sportif Z5',
        'Bein Sport',
        'l\'Apprimerie',
        'Coudoux sport',
        'Science Po',
        'Institus Beauté',
        'Lou Maï',
        'Bein sports',
    ];

    private $status = [
        'Brouillon',
        'Publié',
        'Archivé',
    ];


    // getters

    /**
     * Retourne un tableau de logiciels pour les fixtures
     *
     * @return array
     */
    public function getlogicielsProvider(): array
    {
        return $this->logiciels;
    }

     /**
     * Retourne un tableau de tags pour les fixtures
     *
     * @return array
     */
    public function getTagProvider(): array
    {
        return $this->tag;
    }

     /**
     * Retourne un tableau de nom de projets pour les fixtures
     *
     * @return array
     */
    public function getProjectNameProvider(): array
    {
        return $this->projectName;
    }

    /**
     * Retourne un tableau de logiciels pour les fixtures
     *
     * @return array
     */
    public function getStatusProvider(): array
    {
        return $this->status;
    }

    // ! Liste de methodes de recuperation aléatoire de tableau
     /**
     * Retourne un nom aléatoire de logiciels pour les fixtures
     *
     * @return string
     */
    public function getOneRamdonLogiciel(): string
    {
        return $this->logiciels[array_rand($this->logiciels)];
    }


    /**
     * Retourne un nom aléatoire de tag pour les fixtures
     *
     * @return string
     */
    public function getOneRamdonTag(): string
    {
        return $this->tag[array_rand($this->tag)];
    }

     /**
     * Retourne un nom aléatoire de nom de projet pour les fixtures
     *
     * @return string
     */
    public function getOneRamdonProject(): string
    {
        return $this->projectName[array_rand($this->projectName)];
    }

         /**
     * Retourne un status aléatoire pour les projets et sous projets pour les fixtures
     *
     * @return string
     */
    public function getOneRamdonStatus(): string
    {
        return $this->status[array_rand($this->status)];
    }



}
