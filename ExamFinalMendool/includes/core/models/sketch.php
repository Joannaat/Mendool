<?php
    require_once "includes/core/models/typeVideo.php";
    class Sketch {
        private int $id;
        private string $titre;
        private string $lienVideo;
        private TypeVideo $type;

        public function __construct(string $titre='',string $lienVideo=''){
            $this->id = 0;
            $this->titre = $titre;
            $this->lienVideo = $lienVideo;
            $this->type = new TypeVideo('Sketch');
            $this->type->setId(2);
        }

        public function getId(): int{
            return $this->id;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }


        public function getTitre(): string{
            return $this->titre;
        }

        public function setTitre(string $titre): void{
            $this->titre = $titre;
        }

        public function getLienVideo(): string{
            return $this->lienVideo;
        }

        public function setLienVideo(string $lienVideo): void{
            $this->lienVideo = $lienVideo;
        }
        public function getType(): TypeVideo{
            return $this->type;
        }

        public function setType( TypeVideo $type): void{
            $this->type = $type;
        }
        
    }