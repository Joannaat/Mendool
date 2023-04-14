<?php
    
    class Commentaire {
        private int $idVideo, $idPersonne;
        private string $commentaire;
        private DateTime $date;

        
        
        public function __construct(int $idVideo, int $idPersonne, string $commentaire = '',DateTime $date = null ){
            $this->idVideo = $idVideo;
            $this->idPersonne = $idPersonne;
            $this->commentaire = $commentaire;
            $this->date = $date ?? new DateTime('now');//$date:objet de type DateTime et représente la date et l'heure auxquelles le commentaire a été laissé
        }

        public function getIdVideo(): int{
            return $this->idVideo;
        }

        public function setIdVideo(int $idVideo): void{
            $this->idVideo = $idVideo;
        }

        public function getIdPersonne(): int{
            return $this->idPersonne;
        }

        public function setIdPersonne(int $idPersonne): void{
            $this->idPersonne = $idPersonne;
        }

        public function getCommentaire(): string{
            return $this->commentaire;
        }

        public function setCommentaire(string $commentaire): void{
            $this->commentaire = $commentaire;
        }

        public function getDate(): DateTime{ //Renvoie la date au format français : J/M/A
            return $this->date;
        }

        
        public function setDate(DateTime $date): void{ //affecte la date a $date
            $this->date = $date;
        }
    }