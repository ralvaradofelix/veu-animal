<?php
class i18n extends misc {

    var $lang;

   function loadFromArray($obj) {

        foreach($this->dates as $camp => $tipus) {
            if($obj[$camp]) $obj[$camp] = parseData($obj[$camp]);
        }
        
        foreach($this->varchars as $camp => $tipus) {
            if($obj[$camp]) $obj[$camp] = stripslashes($obj[$camp]);
        }
        
        foreach($this->texts as $camp => $tipus) {
            if($obj[$camp]) $obj[$camp] = stripslashes($obj[$camp]);
        }

        foreach($this->prices as $camp => $tipus) {
            if($obj[$camp]) {
                $obj[$camp] = $obj[$camp] / 100;
                $obj[$camp . '_html'] = number_format($obj[$camp],2,',','.');
            }
        }
        
        /*
        foreach($this->passwords as $camp => $tipus) {
            unset($obj[ $camp ]);
        }
        */ 

        return $obj;
    }


    function load( $id, $lang ) {
        $this->link = $this->connectarse();
        $sql = "SELECT
                    $this->taula.*
                FROM $this->taula
                WHERE $this->taula.id = '$id' 
                    AND lang = '" . $lang . "' 
                ";
        $result = mysql_query($sql,$this->link) or die ('load :: '.mysql_error($this->link));
        $obj = mysql_fetch_assoc($result);
        return $this->loadFromArray($obj);
    }

    
    function loadAllByFields($camps = array(),$order = null)
    {
        $this->link = $this->connectarse();
        $where = array();
        foreach($camps as $camp => $valor) {
            if(is_array($valor)) {
                $conj = array();
                foreach($valor as $v) $conj[] = "$camp = '$v'";
                $where[] = ' (' . implode(') OR (',$conj) . ') ';
            } else $where[] = "$camp = '$valor'";
        }

        if( ! $camps ) $where[]  = ' 1 = 1 ';

        $sql = "SELECT
                    $this->taula.*
                FROM " . $this->taula ."
                WHERE (".implode(") AND (",$where).")
                ";
        if(!$order) $sql .= " ORDER BY $this->taula.id DESC";
        else $sql .= " ORDER BY " . $order;

        $result = mysql_query($sql,$this->link) or die ('load all :: '.mysql_error($this->link));
        $objectes = array();
        while ($obj = mysql_fetch_assoc($result))
        {
            $objectes[] = $this->loadFromArray($obj);
        }
        return $objectes;
    }



    function save( & $obj) {
        if ($obj['id']) $this->update($obj);
        else $this->insert($obj);
    }

    function insert(& $obj)
    {
        $this->link = $this->connectarse();
        $this->lang = isset($obj['lang']) ? $obj['lang'] : $GLOBALS['lang'];
        
        $sql = "INSERT INTO $this->taula (id,lang) VALUES ('" . $obj['id'] . "', '" . $obj['lang'] . "')";
        $result = mysql_query($sql,$this->link) or die ('insert :: ' . mysql_error($this->link));
        
        $this->update($obj);
        return true;
    }

    function update(& $obj)
    {
        $this->lang = isset($obj['lang']) ? $obj['lang'] : $GLOBALS['lang'];
        $this->link = $this->connectarse();

                $registre = array();
                
                foreach( $this->camps as $camp => $tipus) {
                    if($camp != "data_alta" && $camp != "data_modificacio") {
                        if($tipus == 'date') $registre[$camp] = $obj[$camp] ? date('Y-m-d H:i:s',$obj[$camp]) : '0000-00-00';
                        elseif($tipus == "boolean") $registre[ $camp ] = ($obj[ $camp ]) ? 1 : 0;
                        elseif($tipus == "varchar") $registre[ $camp ] = mysql_real_escape_string( $obj[ $camp ], $this->link );
                        elseif($tipus == "text") $registre[ $camp ] = mysql_real_escape_string( $obj[ $camp ], $this->link );
                        elseif($tipus == "password") { 
                            if($obj[ $camp ]) {
                                if(strlen($obj[ $camp ]) < 30) $registre[ $camp ] = mysql_real_escape_string( sha1( $obj['salt'] . $obj[ $camp ] ), $this->link ); 
                                else $registre[ $camp ] = mysql_real_escape_string( $obj[ $camp ], $this->link ); 
                            }
                        }
                        elseif($tipus == "price") $registre[ $camp ] = ($obj[$camp]) ? $obj[$camp] * 100 : $obj[ $camp ];
                        else $registre[$camp] = $obj[$camp];
                    }
                }
                 

                // construim query
                $array_update = array();
                foreach($registre as $key => $valor) $array_update[] = $key . " = '".$valor."' ";
        $sql = "UPDATE $this->taula SET
                    ".implode(',',$array_update)."
                WHERE id = '". $obj['id'] . "' AND lang = '" . $this->lang ."' ";
                
        $result = mysql_query($sql,$this->link) or die ('update :: '.mysql_error($this->link));
        return true;
    }

    function delete($id)
    {
        $sql = "DELETE FROM $this->taula WHERE id = '$id' ";
        $result = mysql_query($sql,$this->link) or die ('delete' . mysql_error($this->link));
        return true;
    }


    public function doSQL() {
        
        $camps = array();
        foreach( $this->camps as $camp => $tipus) {
                if($tipus == 'date') $camps[] = $camp . " DATETIME ";
                elseif($tipus == "boolean") $camps[] = $camp . " TINYINT(1) ";
                elseif($tipus == "varchar") $camps[] = $camp . " VARCHAR(255) ";
                elseif($tipus == "text") $camps[] = $camp . " TEXT ";
                elseif($tipus == "password") $camps[] = $camp . " VARCHAR(255) ";
                elseif($tipus == "price") $camps[] = $camp . " INT ";
                elseif($tipus == "integer") $camps[] = $camp . " INT ";
        }
        
        $create =  "CREATE TABLE " . $this->taula . " (id INT NOT NULL, "
            . implode(",\r\n",$camps)
            . ", PRIMARY KEY (`id`,`lang`) );\r\n";
        
        $alter = null;
        foreach( $camps as $camp ):
            $alter .= "ALTER TABLE  " . $this->taula . " ADD "  . $camp . " NULL DEFAULT NULL;\r\n";
        endforeach;
        
        return $create . "\r\n" ."\r\n" . $alter;
    }

}
?>