<?php

class AnimalPhoto extends ORM {


    function __construct() {
        $this->link = $this->connectarse();
        $this->taula = $GLOBALS['config']['db_ext'] . "animal_photo";

        $this->dates = array(
            'data_alta' => 'date',
            'data_modificacio' => 'date');

        $this->integers = array( // => 'integer'
            'id_animal'     => 'integer',
            'posicio'       => 'integer'
        );

        $this->booleans = array( // => 'boolean'

        );

        $this->varchars = array(
            'image'     => 'varchar',
        );

        $this->texts = array(

        );

        $this->passwords = array( // => 'password'

        );

        $this->prices = array();

        $this->opcions = array();
        $this->to_string = 'image'; // camp a mostrar en cas de to_string

        $this->saveFiles = array('image'); // array("imatge");

        $this->camps = array_merge($this->dates,$this->integers,$this->booleans,$this->passwords,$this->varchars,$this->texts,$this->prices);
    }


}
?>
