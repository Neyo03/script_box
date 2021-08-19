<?php

namespace Model;


class Trophe{

   protected $code;
   protected $nom;
   protected $description;
   protected $image;




   /**
    * Get the value of code
    */ 
   public function getCode()
   {
      return $this->code;
   }

   /**
    * Set the value of code
    *
    * @return  self
    */ 
   public function setCode($code)
   {
      $this->code = $code;

      return $this;
   }

   /**
    * Get the value of nom
    */ 
   public function getNom()
   {
      return $this->nom;
   }

   /**
    * Set the value of nom
    *
    * @return  self
    */ 
   public function setNom($nom)
   {
      $this->nom = $nom;

      return $this;
   }

   /**
    * Get the value of description
    */ 
   public function getDescription()
   {
      return $this->description;
   }

   /**
    * Set the value of description
    *
    * @return  self
    */ 
   public function setDescription($description)
   {
      $this->description = $description;

      return $this;
   }

   /**
    * Get the value of image
    */ 
   public function getImage()
   {
      return $this->image;
   }

   /**
    * Set the value of image
    *
    * @return  self
    */ 
   public function setImage($image)
   {
      $this->image = $image;

      return $this;
   }
}