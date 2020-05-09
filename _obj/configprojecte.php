<?php
class ConfigProjecte extends ORM {
     
        
	function __construct() {
		$this->link = $this->connectarse();
		$this->taula = $GLOBALS['config']['db_ext'] . "config_projecte";

                $this->dates = array('data_alta' => 'date', 
                                     'data_modificacio' => 'date' );
                
                $this->integers = array( // => 'integer'
                    'posicio'   => 'integer'
                ); 
                
                $this->booleans = array( // => 'boolean'
                    'is_hidden' => 'boolean',
                    );
                
                $this->varchars = array(
                    'nom'       => 'varchar',
                    'clau'     => 'varchar',
                    'valor'   => 'varchar'
                    );
                
                $this->texts = array(

                );
                
                $this->passwords = array( // => 'password'
                    
                );
                
                $this->prices = array();
                    
                
                $this->saveFiles = array(); // array("imatge");
                
                $this->opcions = array();
                $this->to_string = 'nom'; // camp a mostrar en cas de to_string
                
                $this->camps = array_merge($this->dates,$this->integers,$this->booleans,$this->passwords,$this->varchars,$this->texts,$this->prices);
                
                
	}
        
}
?>