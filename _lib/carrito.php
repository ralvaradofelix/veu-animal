<?php
class Carrito 
{

	var $carrito = array();

	function Carrito() {
		$this->load();
	}

	function load()
	{
		$modelProducte = model('Producte');
        $total = 0;
		if(isset($_COOKIE['carrito']) && is_array($_COOKIE['carrito']))
		{
			foreach($_COOKIE['carrito'] as $key => $unidades)
			{
				// list( $id, $talla ) = explode("|", $key, 2);
				$id = $key;

				$producte = $modelProducte->load($id);
				if(!$producte) continue; // mort('carrito load producto no existe @00' . $id);

				$preu = ($producte['preu'] * $unidades);
				$this->_afegir( $producte, $unidades );
				$total += $preu;
			}
		}

		return $this->carrito;
	}

	function _afegir( $producte, $unidades ) {
		$preu = ($producte['preu'] * $unidades);
		$this->carrito[ $producte['id'] ] = array (
					'producte_id' 	=> $producte['id'],
					'nom' 		=> $producte['nom_' . $GLOBALS['lang'] ],
					'concepte'	=> $producte['nom_' . $GLOBALS['lang'] ],
					'unitats'	=> $unidades,
					'preu' 		=> $preu
					);
	}


	function afegir($producte_id,$unitats)
	{
		$id = $producte_id;

		$modelProducte = model('Producte');
		$producte = $modelProducte->load($id);

		if( isset($this->carrito[$producte['id']]) ) $unitats += $this->carrito[$producte['id']]['unitats'];

		$this->_afegir( $producte, $unitats);
		setcookie("carrito[" . $producte['id'] . "]",$unitats,time()+60*60*24*365,"/");

		return $this->carrito;
	}





	function treure( $clau )
	{
		setcookie("carrito[" . $clau . "]",null,time()+60*60*24*365,"/");

		$nova = array();
		foreach( $this->carrito as $k => $c ):
			if( $k != $clau ) $nova[] = $c;
		endforeach;

		$this->carrito = $nova;
		return $this->carrito;
	}

	function actualitzar($producte_id,$unitats)
	{
		return setcookie("carrito[" . $producte_id . "]",$unitats,time()+60*60*24*365,"/");
	}

	function buidar()
	{

		if( is_array($_COOKIE['carrito']) ) foreach($_COOKIE['carrito'] as $id => $unidades) {
				setcookie("carrito[" . $id . "]",null,time()+60*60*24*365,"/");
			}

		$this->carrito = array();
	}

	function analitzar()
	{
		$carrito = $this->load();
		foreach($carrito as $producte)
		{
			var_dump($producte);
		}
	}

	function items()
	{
		// return count($this->load());
                $items = $this->load();
                $count = 0;
                foreach( $items as $item ) $count += $item['unitats'];

                return $count;
	}

	function total()
	{
		$carrito = $this->load();
		$total = 0;
		if(is_array($carrito))
		{
			foreach($carrito as $producte) $total += $producte['preu'];
		}

		return $total;
	}


	function transport($transport_id)
	{
		setcookie("pedido[transport]",$transport_id,time()+60*60*24*365,"/");
	}


	function loadTransport()
	{
		return $_COOKIE['pedido']['transport'];
	}
}
?>