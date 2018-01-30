<?php

// Modèle Créneau
class Creneau
{
	private $id = -1; // Primary key
	private $dateDebut = 0; // Timestamp
	private $duree = 0; // Second
	private $estExclusif = false; // Boolean
	private $datePublication = 0; // Timestamp
	private $idProfesseur = 0; // Foreign key
	private $estLibre = false; // Boolean
	private $note = 10; // Integer between 0 and 20
	private $commentaire1 = ""; // String
	private $commentaire2 = ""; // String
	
	public function __construct($id = -1, $dateDebut = 0, $duree = 0, $estExclusif = false,
	                            $datePublication = 0, $idProfesseur = 0, $estLibre = false,
	                            $note = 0, $commentaire1 = "", $commentaire2 = "") {
		$this->setId($id);
		$this->setDateDebut($dateDebut);
		$this->setDuree($duree);
		$this->setEstExclusif($estExclusif);
		$this->setDatePublication($datePublication);
		$this->setIdProfesseur($idProfesseur);
		$this->setEstLibre($estLibre);
		$this->setNote($note);
		$this->setCommentaire1($commentaire1);
		$this->setCommentaire2($commentaire2);
	}
	
	/** Convert a duration like "20:15" (hh:mm) to its equivalent in seconds
	 * @param string $duration
	 * @return int
	 */
	public static function convertDurationToSeconds(string $duration) : int {
		$ar = explode(':', $duration);
		
		if (sizeof($ar) < 2)
			return 0;
		
		$hour = (int) $ar[0];
		$minute = (int) $ar[1];
		
		return $hour * 60 * 60 + $minute * 60;
	}
	
	/**
	 * Convert seconds to "hh:mm" format
	 * @param int $seconds
	 * @return string
	 */
	public static function convertSecondsToDuration(int $seconds) : string {
		$hours = (int) ($seconds / 3600);
		$minutes = (int) (($seconds % 3600) / 60);
		$s = $seconds % 60;
		
		// Round $minutes if $s is greater than 30 seconds.
		if ($s > 30)
			$minutes++;
		
		if (0 <= $hours && $hours <= 9)
			$hours = "0" . $hours;
		
		if (0 <= $minutes && $minutes <= 9)
			$minutes = "0" . $minutes;
		
		return $hours . ":" . $minutes;
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
	 * @return int
	 */
	public function getDateDebut(): int
	{
		return $this->dateDebut;
	}
	
	/**
	 * @param int $dateDebut
	 */
	public function setDateDebut(int $dateDebut): void
	{
		$this->dateDebut = $dateDebut;
	}
	
	/**
	 * @return int
	 */
	public function getDuree(): int
	{
		return $this->duree;
	}
	
	/**
	 * @param int $duree
	 */
	public function setDuree(int $duree): void
	{
		$this->duree = $duree;
	}
	
	/**
	 * @return bool
	 */
	public function getEstExclusif(): bool
	{
		return $this->estExclusif;
	}
	
	/**
	 * @param bool $estExclusif
	 */
	public function setEstExclusif(bool $estExclusif): void
	{
		$this->estExclusif = $estExclusif;
	}
	
	/**
	 * @return int
	 */
	public function getDatePublication(): int
	{
		return $this->datePublication;
	}
	
	/**
	 * @param int $datePublication
	 */
	public function setDatePublication(int $datePublication): void
	{
		$this->datePublication = $datePublication;
	}
	
	/**
	 * @return int
	 */
	public function getIdProfesseur(): int
	{
		return $this->idProfesseur;
	}
	
	/**
	 * @param int $idProfesseur
	 */
	public function setIdProfesseur(int $idProfesseur): void
	{
		$this->idProfesseur = $idProfesseur;
	}
	
	/**
	 * @return bool
	 */
	public function getEstLibre(): bool
	{
		return $this->estLibre;
	}
	
	/**
	 * @param bool $estLibre
	 */
	public function setEstLibre(bool $estLibre): void
	{
		$this->estLibre = $estLibre;
	}
	
	/**
	 * @return int
	 */
	public function getNote(): int
	{
		return $this->note;
	}
	
	/**
	 * @param int $note
	 */
	public function setNote(int $note): void
	{
		$this->note = $note;
	}
	
	/**
	 * @return string
	 */
	public function getCommentaire1(): string
	{
		return $this->commentaire1;
	}
	
	/**
	 * @param string $commentaire1
	 */
	public function setCommentaire1(string $commentaire1): void
	{
		$this->commentaire1 = $commentaire1;
	}
	
	/**
	 * @return string
	 */
	public function getCommentaire2(): string
	{
		return $this->commentaire2;
	}
	
	/**
	 * @param string $commentaire2
	 */
	public function setCommentaire2(string $commentaire2): void
	{
		$this->commentaire2 = $commentaire2;
	}
}

?>