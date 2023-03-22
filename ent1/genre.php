<?php

namespace ent1;

class Genre
{
    private int $Id;
    private string $Nama_genre;

    

    /**
     * Get the value of id
     */ 
    public function getId() : string
    {
        return $this->Id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->Nama_genre;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($Nama_genre)
    {
        $this->Nama_genre = $Nama_genre;

        return $this;
    }
}