<?php
    
    class Tournee{
        private int $id;
        private string $nom_tournee;
        private int $nombre_personnes;
        private ?DateTime $date;//DateTime est une classe deja créee par php dans laquelle nous avons la date et l heure
        private string $localisation;
        private int $duree;
        

        public function __construct(string $nom_tournee = '', int $nombre_personnes = 0, ?DateTime $date = null, string $localisation = '',int $duree=0) {
            $this->id = 0;
            $this->nom_tournee = $nom_tournee;
            $this->nombre_personnes = $nombre_personnes;
            $this->date = $date ?? new DateTime('now');
            $this->localisation = $localisation;
            $this->duree = $duree;
        }

        public function getId(): int{
            return $this->id;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function getNomTournee(): string{
            return $this->nom_tournee;
        }

        public function setNomTournee(string $nom_tournee): void{
            $this->nom_tournee = $nom_tournee;
        }


        public function getNombrepersonnes(): int{
            return $this->nombre_personnes;
        }

        public function setNombrepersonnes(int $nombre_personnes): void{
            $this->nombre_personnes = $nombre_personnes;
        }

        public function getLocalisation(): string{
            return $this->localisation;
        }

        public function setLocalisation(string $localisation): void{
            $this->localisation = $localisation;
        }
        public function getDuree(): int{
            return $this->duree;
        }

        public function setDuree( int $duree): void{
            $this->duree = $duree;
        }

       public function getFullDate(): DateTime{ //Renvoie la date ET l'heure
            return $this->date;
        }

        public function getDate(): string{ //Renvoie la date au format français : J/M/A
            return $this->date->format('d/m/Y');
        }

        
        public function setDate(DateTime $date): void{ //affecte la date a l attribut de la classe
            $this->date = $date;
        }

        public function getHeure(): string{ //Renvoie l'heure au format H:M
            return $this->date->format('H:i');
        } 
        
    }