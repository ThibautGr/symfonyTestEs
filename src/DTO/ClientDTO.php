<?php

namespace App\DTO;
use JMS\Serializer\Annotation as ES;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @Es\Document
 */
class ClientDTO
{

    public function __construct(
        string $nom = null,
        string $email = null,
    )
    {
    }

    /**
     * @Groups({"elastica"})
     */
    public $nom;

    /**
     * @Groups({"elastica"})
     */
    public $email;



}