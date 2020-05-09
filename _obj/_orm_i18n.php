<?php
class ORM_I18n extends ORM {
       

    function load( $id ) {
        $lang = $GLOBALS['lang']; 

        $this->link = $this->connectarse();
        $sql = "SELECT
                    " . $this->taula . ".*,
                    " . $this->taula . "_i18n.*
                FROM $this->taula
                LEFT JOIN " . $this->taula . "_i18n 
                    ON ( " . $this->taula . ".id = " . $this->taula . "_i18n.id AND lang = '" . $lang . "' ) 
                WHERE $this->taula.id = $id";
        $result = mysql_query($sql,$this->link) or die ('load :: '.mysql_error($this->link));
        $obj = mysql_fetch_assoc($result);
        return $this->loadFromArray($obj);
    }

    function loadByFields( $camps, $order = null ) {
        $lang = $GLOBALS['lang']; 

        $this->link = $this->connectarse();
        $where = array();
        foreach($camps as $c => $v) $where[] = $this->taula.'.'.$c . " = '".addslashes($v)."' ";
        if($order) $order = " ORDER BY " . $order;
        $sql = "SELECT
                    " . $this->taula . ".*,
                    " . $this->taula . "_i18n.*
                FROM $this->taula
                LEFT JOIN " . $this->taula . "_i18n 
                    ON ( " . $this->taula . ".id = " . $this->taula . "_i18n.id AND lang = '" . $lang . "' ) 
                WHERE 1
                AND (" . implode(') AND (',$where) . ')
                ' . $order;

        $result = mysql_query($sql,$this->link) or die ('load by fields :: '.mysql_error($this->link));
        $obj = mysql_fetch_assoc($result);
        return $this->loadFromArray($obj);
    }
    

    function loadAll( $order = null ) {
        $lang = $GLOBALS['lang']; 

        $this->link = $this->connectarse();
        $sql = "SELECT
                    " . $this->taula . ".*,
                    " . $this->taula . "_i18n.*
                FROM $this->taula
                LEFT JOIN " . $this->taula . "_i18n 
                    ON ( " . $this->taula . ".id = " . $this->taula . "_i18n.id AND lang = '" . $lang . "' ) 
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


    function loadAllByFields($camps = array(),$order = null) {
        $lang = $GLOBALS['lang']; 

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
                    " . $this->taula . ".*,
                    " . $this->taula . "_i18n.*
                FROM $this->taula
                LEFT JOIN " . $this->taula . "_i18n 
                    ON ( " . $this->taula . ".id = " . $this->taula . "_i18n.id AND lang = '" . $lang . "' ) 
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


    function loadAllByWhere($where,$order = null) {
        $this->link = $this->connectarse();
        $lang = $GLOBALS['lang']; 
         
        $sql = "SELECT
                    " . $this->taula . ".*,
                    " . $this->taula . "_i18n.*
                FROM $this->taula
                LEFT JOIN " . $this->taula . "_i18n 
                    ON ( " . $this->taula . ".id = " . $this->taula . "_i18n.id AND lang = '" . $lang . "' ) 
                WHERE " . $where . " ";
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



    function insert(& $obj)
    {
        $this->link = $this->connectarse();

        $sql = "INSERT INTO $this->taula (data_alta, data_modificacio) VALUES (NOW(), NOW())";
        $result = mysql_query($sql,$this->link) or die ('insert :: ' . mysql_error($this->link));
        $obj['id'] = mysql_insert_id();

        $this->update($obj);
        return true;
    }

    function update(& $obj) {
            
        $this->link = $this->connectarse();

        if($this->saveFiles) $this->tractarImatges($obj,$this->saveFiles);

        $registre = array();
        
        if( ! $obj['salt'] ) $obj['salt'] = $this->salt();
        
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
                    data_modificacio = NOW(),
                    ".implode(',',$array_update)."
                WHERE id =". $obj['id'];
                
        $result = mysql_query($sql,$this->link) or die ('update :: '.mysql_error($this->link));

        // i18n
        $lang = $obj['lang'] ? $obj['lang'] : $GLOBALS['lang'];
        $i18n = model( get_class($this) . '_i18n' );

        $exists = $i18n->load( $obj['id'], $lang );
        if( ! $exists ) {
            $exists = array('id' => $obj['id'], 'lang' => $lang);
            $i18n->insert( $exists );
        }

        foreach( $i18n->camps as $camp => $tipus ) {
            $exists[$camp] = $obj[$camp];
        }

        $i18n->save( $exists );


        return true;
    }

    function delete($id)
    {
        $sql = "DELETE FROM ". $this->taula . " WHERE id = '" . $id . "' ";
        $result = mysql_query($sql,$this->link) or die ('delete' . mysql_error($this->link));

        $sql = "DELETE FROM " . $this->taula . "_i18n WHERE id = '" . $id . "' ";
        $result = mysql_query($sql,$this->link) or die ('delete' . mysql_error($this->link));
        return true;
    }


}
?>