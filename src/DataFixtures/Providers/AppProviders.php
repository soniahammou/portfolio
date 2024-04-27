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
        'Lou Maï',
        'Bein sports',
    ];



    public function logiciels(): array
    {
        return $this->logiciels;
    }

    public function tag(): array
    {
        return $this->tag;
    }
    public function projectName(): array
    {
        return $this->projectName;
    }


    public function logicielsTitle(): string
    {
        return $this->logiciels[array_rand($this->logiciels)];
    }

    public function tagTitle(): string
    {
        return $this->tag[array_rand($this->tag)];
    }

    public function projecNameTitle(): string
    {
        return $this->projectName[array_rand($this->projectName)];
    }


}
