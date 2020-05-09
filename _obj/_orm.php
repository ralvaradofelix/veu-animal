<?php
class ORM extends misc {
        var $dates;
        var $integers;
        var $booleans;
        var $varchars;
        var $passwords;
        var $prices;
        var $camps;
         

    function loadFromArray($obj)
    {
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


    function load($id)
    {
        $this->link = $this->connectarse();
        if( ! is_numeric($id) ) return array();

        $sql = "SELECT
                    $this->taula.*
                FROM $this->taula
                WHERE $this->taula.id = '$id'";
        $result = $this->link->query($sql) or die("load :: " . mysqli_error($this->link) );
        $obj = $result->fetch_assoc();

        return $this->loadFromArray($obj);
    }

    function loadByFields($camps,$order = null)
    {
        $this->link = $this->connectarse();
        $where = array();
        foreach($camps as $c => $v) $where[] = $this->taula.'.'.$c . " = '".addslashes($v)."' ";
        if($order) $order = " ORDER BY " . $order;
        $sql = "SELECT
                    $this->taula.*
                FROM $this->taula
                WHERE 1
                AND (" . implode(') AND (',$where) . ')
                ' . $order;

        $result = $this->link->query($sql) or die ('load by fields :: '.mysqli_error($this->link));
        $obj = $result->fetch_assoc();
        return $this->loadFromArray($obj);
    }
    
    function loadByKey($key) {
            $this->link = $this->connectarse();
            $key = mysqli_real_escape_string( $this->link, $key );
            
        $sql = "SELECT $this->taula.*
                        FROM $this->taula
                        WHERE MD5(CONCAT(email,nick,pwd))  = '$key'
                        LIMIT 1";
        $result = $this->link->query($sql) or die ('load :: '.mysqli_error($this->link));
        $obj = $result->fetch_assoc();
        return $this->loadFromArray($obj);
    }

    function loadAll( $order = null )
    {
        $this->link = $this->connectarse();
        $sql = "SELECT
                    $this->taula.*
                FROM $this->taula
                 ";
        if(!$order) $sql .= " ORDER BY $this->taula.id DESC";
        else $sql .= " ORDER BY " . $order;
        $result = $this->link->query($sql) or die ('load all :: '.mysqli_error($this->link));
        $objectes = array();
        while ($obj = $result->fetch_assoc())
        {
            $objectes[] = $this->loadFromArray($obj);
        }
        return $objectes;
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

        $result = $this->link->query($sql) or die ('load all :: '.mysqli_error($this->link));
        $objectes = array();
        while ($obj = $result->fetch_assoc())
        {
            $objectes[] = $this->loadFromArray($obj);
        }
        return $objectes;
    }

    function loadAllByWhere($where,$order = null)
    {
        $this->link = $this->connectarse();
         
        $sql = "SELECT
                    $this->taula.*
                FROM " . $this->taula ."
                WHERE " . $where . " ";
        if(!$order) $sql .= " ORDER BY $this->taula.id DESC";
        else $sql .= " ORDER BY " . $order;

        $result = $this->link->query($sql) or die ('load all :: '.mysqli_error($this->link));
        $objectes = array();
        while ($obj = $result->fetch_assoc())
        {
            $objectes[] = $this->loadFromArray($obj);
        }
        return $objectes;
    }

        function loadAllByFieldsFuture($camps = array(),$order = null)
    {
        $this->link = $this->connectarse();
        $where = array(' DATE(data) >= DATE(NOW()) ');
        foreach($camps as $camp => $valor) {
            if(is_array($valor)) {
                $conj = array();
                foreach($valor as $v) $conj[] = "$camp = '$v'";
                $where[] = ' (' . implode(') OR (',$conj) . ') ';
            } else $where[] = "$camp = '$valor'";
        }

        $sql = "SELECT $this->taula.*
                        FROM " . $this->taula ."
                        WHERE (".implode(") AND (",$where).")
                        ";
        if(!$order) $sql .= " ORDER BY $this->taula.id DESC";
        else $sql .= " ORDER BY " . $order;

        $result = $this->link->query($sql) or die ('load all :: '.mysqli_error($this->link));
        $objectes = array();
        while ( $obj = $result->fetch_assoc() )
        {
            $objectes[] = $this->loadFromArray($obj);
        }
        return $objectes;
    }
        
       

    function _load_from_array( $array ) {
        foreach ($array as $key => $value) {
            if( $value == '0000-00-00 00:00:00') $array[ $key ] = null;
                    if( $value == '0000-00-00') $array[ $key ] = null;
        }

        return $array;
    }

 

    function loadAllQuery( $query ) {
        $this->link = $this->connectarse();

        $result = $this->link->query($query) or die('Invalid _db_ query: ' . mysqli_error($this->link) );
        $retorn = array();
        while( $row = $result->fetch_assoc() ) {
            $retorn[] = $this->_load_from_array( $row );
        }

        return $retorn;
    }



    function execQuery( $query ) {
        $this->link = $this->connectarse();
        $this->link->query($query) or die('Invalid _db_ exec query: ' . mysqli_error($this->link) );
        return null;
    }


    function loadQuery( $query ) {
        $this->link = $this->connectarse();
        
        $result = $this->link->query($query) or die('Invalid _db_ query: ' . mysqli_error($this->link) );
        $retorn = $result->fetch_assoc();
        
        return $this->_load_from_array( $retorn );
    }



    function validate($obj)
    {
        $errors = array();
        // codi únic
        return $errors;
    }

    function save( & $obj) {
        if( isset($obj['id']) && $obj['id'] ) $this->update( $obj );
        else $this->insert($obj);
    }

    function insert(& $obj)
    {
        $this->link = $this->connectarse();

        $sql = "INSERT INTO $this->taula (data_alta, data_modificacio) VALUES (NOW(), NOW())";
        $result = $this->link->query($sql) or die ('insert :: ' . mysqli_error($this->link));
        $obj['id'] = mysqli_insert_id($this->link);
        $this->update($obj);
        return true;
    }

    function update(& $obj)
    {
            
        $this->link = $this->connectarse();

        if($this->saveFiles) $this->tractarImatges($obj,$this->saveFiles);

        $registre = array();
        
        if( ! isset($obj['salt']) || ! $obj['salt'] ) $obj['salt'] = $this->salt();
        
        foreach( $this->camps as $camp => $tipus) {
            if($camp != "data_alta" && $camp != "data_modificacio") {
                if($tipus == 'date') $registre[ $camp ] = ( isset( $obj[$camp] ) && $obj[$camp] ) ? date('Y-m-d H:i:s',$obj[$camp]) : '0000-00-00';
                elseif($tipus == "boolean") $registre[ $camp ] = ( isset($obj[ $camp ]) && $obj[ $camp ]) ? 1 : 0;
                elseif($tipus == "varchar") $registre[ $camp ] = mysqli_real_escape_string( $this->link, isset($obj[ $camp ]) ? $obj[ $camp ] : null );
                elseif($tipus == "text") $registre[ $camp ] = mysqli_real_escape_string( $this->link, isset($obj[ $camp ]) ? $obj[ $camp ] : null );
                elseif($tipus == "password") { 
                    if(isset( $obj[ $camp ] ) && $obj[ $camp ] ) {
                        if(strlen($obj[ $camp ]) < 30) $registre[ $camp ] = mysqli_real_escape_string( $this->link, sha1( $obj['salt'] . $obj[ $camp ] ) ); 
                        else $registre[ $camp ] = mysqli_real_escape_string( $this->link, $obj[ $camp ] ); 
                    }
                }
                elseif($tipus == "price") {
                    if(isset($obj[$camp])) $registre[ $camp ] = $obj[$camp] ? $obj[$camp] * 100 : $obj[ $camp ];
                    else $registre[ $camp ] = null;
                }
                else $registre[$camp] = isset($obj[$camp]) ? $obj[$camp] : null;
            }
        }
         

        // construim query
        $array_update = array();
        foreach($registre as $key => $valor) $array_update[] = $key . " = '".$valor."' ";
        $sql = "UPDATE $this->taula SET
                    data_modificacio = NOW(),
                    ".implode(',',$array_update)."
                WHERE id =". $obj['id'];
                
        $result = $this->link->query($sql) or die ('update :: '.mysqli_error($this->link));
        return true;
    }

    function delete($id)
    {
        if( is_array($id) && isset($id['id']) && is_numeric($id['id']) ) { // ens passen un registre
            $id = $id['id'];
        } 

        if( ! is_numeric($id) ) return false; // no deixem passar

        $sql = "DELETE FROM " . $this->taula . " WHERE id = '" . $id . "' ";
        $this->link->query($sql) or die ('delete' . mysqli_error($this->link));
        
        if( isset($this->delete_cascade) && is_array($this->delete_cascade) ) {
            foreach( $this->delete_cascade as $table => $field ) {
                $sql = "DELETE FROM " . $table . " WHERE " . $field . " = '" . $id . "' ";
                $this->link->query($sql) or die ('delete ' . $table . mysqli_error($this->link));
            }
        }

        return true;
    }

        
    function tractarImatges (& $obj,$keys)
    {
        $dir = file_exists('_var') ? '' : '../';
        $obj_old = $this->load($obj['id']);
        if( !file_exists( $dir . '_var/'.$this->taula) ) mkdir( '../_var/'.$this->taula, 0775);
                
        foreach($keys as $key)
        {
            if(isset($obj[$key]) && $obj[$key] != $obj_old[$key] )
            {
                if($obj_old[$key])
                {
                    $ruta = $dir . '_var/'.$this->taula.'/' . $obj['id'] . '-' . $key . '-  ' . $obj_old[$key];
                    $ok = @unlink($ruta);
                    // if(!$ok) mort("No s'ha pogut eliminar el fitxer.");
                }

                if($obj[$key .'_tmp'])
                {
                    $e = explode('.',$obj[$key]);
                    $ext = end($e);
                    $obj[$key] = time() . '.' . $ext;

                    $ruta = $dir . '_var/'.$this->taula.'/' . $obj['id'] . '-' . $key . '-' . $obj[$key];
                    // $ok = move_uploaded_file($obj[$key.'_tmp'],$ruta);
                    $ok = copy($obj[$key.'_tmp'],$ruta);
                    unlink($obj[$key.'_tmp']);
                                        
                    if(!$ok) mort("No s'ha pogut moure el fitxer.");
                    @chmod($ruta,0755);
                }
            }
        }
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
            
            $create =  "CREATE TABLE " . $this->taula . " (id INT NOT NULL AUTO_INCREMENT, "
                . implode(",\r\n",$camps)
                . ", PRIMARY KEY (`id`) );\r\n";
            
            $alter = null;
            foreach( $camps as $camp ):
                $alter .= "ALTER TABLE  " . $this->taula . " ADD "  . $camp . " NULL DEFAULT NULL;\r\n";
            endforeach;
            
            return $create . "\r\n" ."\r\n" . $alter;
        }
        
        
        public function doURL( $video ) {
            global $config;
            
            $tipus = $this->opcions['tipus_id'][ $video['tipus_id'] ];
            $url = $config['base'] . $tipus . '/' . $video['categoria_id'] . '/' . $video['id'] . '.html';
            
            return $url;
        }
        
    public static function salt() {
        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
?>