<?php
    
    class User {
        private int $id;
        private string $login;
        private string $mdp;
        private bool $visiteur;
        private string $nom;
        private string $prenom;
        private string $mail;
        
        
        public function __construct(string $login = '',string $mdp = '', bool $visiteur = true, string $nom = '',string $prenom = '', string $mail = '' ){
            $this->id = 0;
            $this->login = $login;
            $this->mdp= $mdp;
            $this->visiteur=$visiteur;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->mail=$mail;
        }

        public function getId(): int{
            return $this->id;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function getLogin(): string{
            return $this->login;
        }

        public function setLogin(string $login): void{
            $this->login = $login;
        }

        public function getMdp(): string{
            return $this->mdp;
        }

        public function setMdp(string $mdp): void{
            $this->mdp = $mdp;
        }

        public function getVisiteur(): bool{
            return $this->visiteur;
        }

        public function setVisiteur(bool $visiteur): void{
            $this->visiteur=$visiteur;
        }

        public function getNom(): string{
            return $this->nom;
        }

        public function setNom(string $nom): void{
            $this->nom = $nom;
        }

        public function getPrenom(): string{
            return $this->prenom;
        }

        public function setPrenom(string $prenom): void{
            $this->prenom = $prenom;
        }

        public function getMail(): string{
            return $this->mail;
        }

        public function setMail(string $mail): void{
            $this->mail = $mail;
        }
    }