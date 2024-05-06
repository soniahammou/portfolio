<?php 

namespace App\DTO;

// mettre un ALIAS pour plus de clarrté pour les contraintes de  validation
use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO 
{
        #[Assert\NotBlank]
        #[Assert\Length(min : 3, max : 100)]
        public string $firstname ='';


        #[Assert\NotBlank]
        #[Assert\Length(min : 3, max : 150)]
        public string $lastname ='';
        
        #[Assert\NotBlank]
        #[Assert\Email]
        #[Assert\Regex("/[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/")]
        public string $email ='';

        #[Assert\NotBlank]
        #[Assert\Length(min : 3, max : 300)]
        public string $message ='';

}