<?php


namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ColorStatusService extends AbstractController
{

    private string $statusName = '';

    private array  $colorStatus = [
        "Publié" => "ForestGreen",
        "Brouillon" => "Grey",
        "Archivé" => "Red",
    ];

    /**
     * Selectionne une puce de couleur en fonction du status d'un projets ou sous-projets
     * @param [type] $entity
     * @return string
     */
    public function getColorStatusbyId($entity)
    {

        foreach ($this->getColorStatus() as $key => $value) {

            if ($entity->getStatus() === $key) {
                return $this->setStatusName($value);
            }
        }
    }
 /**
     * Selectionne une puce de couleur en fonction du status d'un projets ou sous-projets
     * @param [type] $findAll de l'entité
     * @return array
     */
    public function getAllColorStatus($findAllArray)
    {

        $allProjet = [];

        foreach ($findAllArray as $projet) {
            $projetStatus = $projet->getStatus();

            $matchStatus = false;

            // je parcours chaque élément du findAll
            do {
                // Parcourir chaque élément du tableau des couleurs
                foreach ($this->getColorStatus() as $status => $color) {
                    // Vérifier si le statut du projet correspond à une entrée du tableau des couleurs
                    if ($status === $projetStatus) {
                        // dump($this);
                        // Mettre à jour la couleur du statut
                        $this->setStatusName($color);
                        $allProjet[] = $this->getStatusName();

                        // Marquer qu'une correspondance a été trouvée
                        $matchStatus = true;
                        // Sortir de la boucle interne
                    break;
                    }
                }

                // Sortir de la boucle do-while si aucune correspondance n'a été trouvée
            } while (!$matchStatus);
        }
        // dump($projetColor);

        // dd('');


        // Retourner l'instance actuelle pour permettre le chaînage des méthodes si nécessaire
        return $allProjet;
    }
    /**
     * Get the value of statusName
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Set the value of statusName
     *
     * @return  self
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * Get the value of colorStatus
     */
    public function getColorStatus()
    {
        return $this->colorStatus;
    }

    /**
     * Set the value of colorStatus
     *
     * @return  self
     */
    public function setColorStatus($colorStatus)
    {
        $this->colorStatus = $colorStatus;

        return $this;
    }
}
