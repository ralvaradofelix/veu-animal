<?php

class Animal extends ORM {


    function __construct() {
        $this->link = $this->connectarse();
        $this->taula = $GLOBALS['config']['db_ext'] . "animal";

        $this->dates = array(
            'data_alta' => 'date',
            'data_modificacio' => 'date',
            'fecha_nacimiento' => 'date',
            'fecha_entrada' => 'date'
        );

        $this->integers = array( // => 'integer'
        );

        $this->booleans = array( // => 'boolean'
            'actiu' => 'boolean',
            'es_adoptado' => 'boolean',
            'es'
        );

        $this->varchars = array(
            'nom'               => 'varchar',
            'especie'           => 'varchar',
            'sexo'              => 'varchar',
            'raza'              => 'varchar',
            'edat'              => 'varchar',
            'tamanyo'           => 'varchar'
        );

        $this->texts = array(
            'misc_esp'              => 'text',
            'caracter_esp'          => 'text',
            'historia_esp'          => 'text',

            'misc_cat'              => 'text',
            'caracter_cat'          => 'text',
            'historia_cat'          => 'text'
        );

        $this->passwords = array( // => 'password'

        );

        $this->prices = array();

        $this->opcions = array();
        $this->to_string = 'nom'; // camp a mostrar en cas de to_string

        $this->saveFiles = array(); // array("imatge");

        $this->camps = array_merge($this->dates,$this->integers,$this->booleans,$this->passwords,$this->varchars,$this->texts,$this->prices);
    }


}
?>
