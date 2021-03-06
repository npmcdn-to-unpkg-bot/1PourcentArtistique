<?php
/*Connects to the database*/
require_once 'connectionDB.php';

	class Admin
	{

		/**
		* ID of the admin
		* @var integer
		*/
		private $id_admin;

		/**
		* Email adress for the accounts
		* @var string
		*/
		private $email_admin;

		/**
		* Password for the accounts
		* @var string
		*/
		private $mdp_admin;

		/**
		* Token to verify if it is the good admin
		* @var string
		*/
		private $token_admin;

		/**
		* Connexion on the database 
		* @var string
		*/
		private $db;


		/**
		* Constructor
		* @param string $id_admin
		* @param string $email_admin
		* @param string $mdp_admin
		* @param string $token_admin
		*/
		public function __construct ($id_admin, $email_admin, $mdp_admin, $token_admin)
		{
			$this->db = connection();
			$this->id_admin = $id_admin;
			$this->email_admin = $email_admin;
			$this->mdp_admin = $mdp_admin;
			$this->token_admin = $token_admin;
		}

		/**
		* Add an admin in the database
		* @return If it's insert or not
		*/
		public function createAdmin()
		{
			$query = $this->db->prepare("INSERT INTO Admin (id_admin, email_admin, mdp_admin, token_admin) VALUES (:id_admin, :email_admin, :mdp_admin, :token_admin);");
			$query->execute(array(
				'id_admin' => $this->id_admin,
				'email_admin' => $this->email_admin,
				'mdp_admin' => $this->mdp_admin,
				'token_admin' => $this->token_admin
				));
			return $query;
		}

		/**
		* Change the token of the administrator when logging to match with the generated cookie
		* @param string $token
		* @return The new token
		*/
		public function changeToken($token)
		{
			$query = $this->db->prepare("UPDATE Admin SET token_admin = :token_admin WHERE email_admin = :email_admin");
			$query->execute(array(
				'token_admin' => $token,
				'email_admin' => $this->email_admin
				));
			return $query;//->fetchAll();
		}

		/**
		* Retrieve administrators 
		* @return All administrator
		*/
		public function selectAllAdmin()
		{
			$query = $this->db->prepare("SELECT id_admin, email_admin, mdp_admin, token_admin  FROM Admin");
			$query->execute();
			return $query->fetchAll();
		}

		/**
		* Get the token of an administrator by ID
		* @return string token
		*/
		public function getTokenById()
		{
			$this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			$query = $this->db->prepare("SELECT token_admin FROM Admin WHERE id_admin = :id_admin");
			$query->execute(array(
				'id_admin' => $this->id_admin
				));
			return $query->fetchAll();
		}

		/**
		* Test if the administrator exist in the database
		* @return integer 0 or 1
		*/
		public function exist()
		{
			$query = $this->db->prepare("SELECT 1 FROM Admin WHERE email_admin = :email_admin AND mdp_admin = :mdp_admin");
			$query->execute(array(
				'email_admin' => $this->email_admin,
				'mdp_admin' => $this->mdp_admin
				));
			return count($query->fetchAll()) > 0;
		}

		/**
		* Retrieves informations of administrator
		* @return string all information of an adminstrator
		*/
		public function read()
		{
			$query = $this->db->prepare("SELECT id_admin, email_admin, mdp_admin, token_admin  FROM Admin WHERE email_admin = :email_admin AND mdp_admin = :mdp_admin");
			$query->execute(array(
				'email_admin' => $this->email_admin,
				'mdp_admin' => $this->mdp_admin
				));
			return $query->fetchAll();
		}

		/**
		* Test if the administrator exist in the database whith email adress
		* @return If it existe or not
		*/
		public function existByEmail()
		{
			$query = $this->db->prepare("SELECT id_admin, email_admin, mdp_admin, token_admin  FROM Admin WHERE email_admin = :email_admin");
			$query->execute(array(
				'email_admin' => $this->email_admin
				));
			return $query->fetchAll();
		}


		/**
		* Change the password of the administrator
		* @return The new password
		*/
		public function changePassword()
		{
			$query = $this->db->prepare("UPDATE Admin SET mdp_admin = :mdp_admin WHERE id_admin = :id_admin");
			$query->execute(array(
				'mdp_admin' => $this->mdp_admin,
				'id_admin' => $this->id_admin
				));
			return $query;//->fetchAll();
		}

		/**
		 * Change the password of an admin by an email adress
		 * @return The new password
		*/
		public function changePasswordByMail()
		{
			$query = $this->db->prepare("UPDATE Admin SET mdp_admin = :mdp_admin WHERE email_admin = :email_admin");
			$query->execute(array(
				'mdp_admin' => $this->mdp_admin,
				'email_admin' => $this->email_admin
				));
			return $query;//->fetchAll();
		}
	}