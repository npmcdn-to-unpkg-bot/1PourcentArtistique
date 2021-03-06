<?php
	/*Connects to the database*/
	require_once 'connectionDB.php';

	class Photography {

		/**
		* Name of the photography
		* @var string
		*/
		private $nameFile;

		/**
		* Name of the art
		* @var integer
		*/
		private $idArt;

		/**
		* Connexion on the database 
		* @var string
		*/
		private $db;

		/**
		* Constructor
		* @param string $nameFile
		* @param integer $idArt
		*/
		public function __construct ($nameFile, $idArt)
		{
			$this->db = connection();
			$this->nameFile = $nameFile;
			$this->idArt = $idArt;
		}

		/**
		* Save the photography for an art with his name and the id of the art
		* @return If it is save
		*/
		public function save () {
			$insert = $this->db->prepare("INSERT INTO PHOTOGRAPHY(nameFile, idArt) 
				VALUES (?, ?)");
			return $insert->execute(array($this->nameFile, $this->idArt));
		}

		/**
		* Delete the photography of an art with his name and the id of the art
		* @return If the deletion worked
		*/
		public function delete() {
			$delete = $this->db->prepare("DELETE FROM PHOTOGRAPHY WHERE nameFile = ? AND idArt = ?");
			return $delete->execute(array($this->nameFile, $this->idArt));
		}

		/**
		* Test if the name of the photography already exist in the database by his name and the id of the art
		* @return integer 0 or 1
		*/
		function exist() {
			$exist = $this->db->prepare("SELECT 1 FROM PHOTOGRAPHY WHERE nameFile = ? ");
			$exist->execute(array($this->nameFile));
			return count($exist->fetchAll()) >= 1;
		}
	
	    /**
	     * Gets the Name of the photography.
	     *
	     * @return string
	     */
	    public function getNameFil()
	    {
	        return $this->nameFile;
	    }

	    /**
	     * Sets the Name of the photography.
	     *
	     * @param string $newNameFil the name fil
	     */
	    private function setNameFil($newNameFile)
	    {
	        $this->nameFile = $newNameFile;
	    }

	    /**
	     * Gets the Name of the art.
	     *
	     * @return integer
	     */
	    public function getidArt()
	    {
	        return $this->idArt;
	    }

	    /**
	     * Sets the Name of the art.
	     *
	     * @param integer $newidArt the name art
	     */
	    private function setidArt($newidArt)
	    {
	        $this->idArt = $newidArt;
	    }
	}