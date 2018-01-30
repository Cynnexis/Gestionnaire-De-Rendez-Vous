<?php

// Model de Professeur
class Professeur
{
	private $id = 0; // Primary key
	private $prenom = ""; // String
	private $nom = "";
	
	public function __construct($id = 0, $prenom = "", $nom = "") {
		$this->setId($id);
		$this->setPrenom($prenom);
		$this->setNom($nom);
	}
	
	/* GETTERS & SETTERS */
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function getPrenom(): string
	{
		return $this->prenom;
	}
	
	/**
	 * @param string $prenom
	 */
	public function setPrenom(string $prenom): void
	{
		$this->prenom = $prenom;
	}
	
	/**
	 * @return string
	 */
	public function getNom(): string
	{
		return $this->nom;
	}
	
	/**
	 * @param string $nom
	 */
	public function setNom(string $nom): void
	{
		$this->nom = $nom;
	} // String
	
	/* GETTERS & SETTERS */
	
	
}

?>