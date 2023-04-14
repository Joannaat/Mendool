<?php
    require_once "includes/core/models/typeVideo.php";
    class Chronique {//je cree une classe chronique qui contient 4 proprietes privees
        private int $id;
        private string $titre;
        private string $lienVideo;
        private TypeVideo $type;//$type :est un objet de la classe TypeVideo représentant le type de la vidéo



        public function __construct(string $titre='',string $lienVideo=''){//cree mon constructeur
            $this->id = 0;
            $this->titre = $titre;
            $this->lienVideo = $lienVideo;
            $this->type = new TypeVideo('Chronique');
            $this->type->setId(1);//propriété $type est initialisée avec un objet TypeVideo qui représente le type "Chronique" et qui a un identifiant de 1
        }

        public function getId(): int{//methode qui renvoie la valeur de l'id
            return $this->id;
        }

        public function setId(int $id): void{//meth definit la valeur de la propriété id de  l objet
            $this->id = $id;
        }

        public function getTitre(): string{//meth qui renvoie le titre
            return $this->titre;
        }

        public function setTitre(string $titre): void{
            $this->titre = $titre;
        }

        public function getLienVideo(): string{//meth renvoie le lien de la video
            return $this->lienVideo;
        }

        public function setLienVideo(string $lienVideo): void{
            $this->lienVideo = $lienVideo;
        }
        public function getType(): TypeVideo{//meth qui renvoie le type de la video
            return $this->type;
        }

        public function setType( TypeVideo $type): void{
            $this->type = $type;
        }
    }