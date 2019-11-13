<?php 
    /**
     * @Entity @Table(name="agregateur")
     * */
    class Agregateur extends \Model implements JsonSerializable{

        /**
         * @Id @GeneratedValue @Column(type="integer")
         * @var int
         * */
        protected $id;
        /**
         * @Column(name="nom", type="string" , length=255 )
         * @var string
         **/
        private $nom;
        /**
         * @Column(name="reference", type="string" , length=255 )
         * @var string
         **/
        private $reference; 
        

        
        public function __construct($id = null){
            
                if( $id ) { $this->id = $id; }   
                          
}

        public function getId() {
            return $this->id;
        }
        public function getNom() {
            return $this->nom;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }
        
        public function getReference() {
            return $this->reference;
        }

        public function setReference($reference) {
            $this->reference = $reference;
        }
        
        
        public function jsonSerialize() {
                return [
                        'id' => $this->id,
                                'nom' => $this->nom,
                                'reference' => $this->reference,
                ];
        }
        
}
