<?php
    class TypeVideo{
        private int $id;
        private string $libelle;


        public function __construct(string $id='',string $libelle=''){
            $this->id = 0;
            $this->libelle = $libelle;
        }

        public function getId(): int{
            return $this->id;
        }

        public function setId(int $id): void{
            $this->id = $id;
        }

        public function getLibelle(): string{
            return $this->libelle;
        }

        public function setLibelle(string $libelle): string{
            $this->titre = $libelle;
        }
    }