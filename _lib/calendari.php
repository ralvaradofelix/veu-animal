<?php 
/*
 *	Construeix cadena d'intervals entre dates per mostrar a la part pública.
 *	@return String ja construït.
 *	- dd/mm/Y a les hh:ii
 *	- dd/mm/Y de hh:ii a hh:ii
 *	- Del dd/mm/Y al dd/mm/Y
 */
 
function parseActe($inici_time,$fi_time)
{
	$inici = date('d/m/Y',$inici_time);
	$fi = date('d/m/Y',$fi_time);
	$inici_hora = date('H:i',$inici_time);
	$fi_hora = date('H:i',$fi_time);
	
	if (($inici == $fi) && ($inici_hora == $fi_hora)) return $inici . ' a les '.$inici_hora;
	else if (($inici == $fi) && ($inici_hora != $fi_hora)) return $inici . ' de '.$inici_hora.' a ' . $fi_hora;
	else return 'Del '. $inici .' al ' . $fi;
}


function miradia($dia,$mes,$any) {
	
	$modelActivitat = model('Activitat');
	$time = mktime(0,0,0,$mes,$dia,$any);
	$actes = $modelActivitat->loadAllByField('DATE(data)',date('Y-m-d',$time));	

	
    if (count($actes)) 
	{
        echo '<td class="marcat">';
        echo '<a href="activitats.php?time='.$time.'" class="dia">';
		echo ((int) $dia < 10) ? '0' : '';
        echo $dia.'</a>';
        echo '</td>';
    }
    else if(($dia . '-'  . $mes . '-' . $any) == date('d-m-Y'))
	{
		echo '<td class="normal"><strong>';
		echo ((int) $dia < 10) ? '0' : '';
		echo $dia.'</strong></td>';
	}
	else 
	{
		echo '<td class="normal">';
		echo ((int) $dia < 10) ? '0' : '';
		echo $dia.'</td>';
	}
}

function calendari($mes,$any)
{	
	$time = mktime(0,0,0, $mes, 1, $any);
	$date = getdate($time);
	// $dayTotal = cal_days_in_month(0, $date['mon'], $date['year']);
	$dayTotal = date('t',$time);
	
	//Print the calendar header with the month name.
	switch($date['month']) {
		case "January": $mes_nom = "Gener"; break;
		case "February": $mes_nom = "Febrer"; break;
		case "May": $mes_nom = "Maig"; break;
		case "April": $mes_nom = "Abril"; break;
		case "March": $mes_nom = "Març"; break;
		case "June": $mes_nom = "Juny"; break;
		case "July": $mes_nom = "Juliol"; break;
		case "August": $mes_nom = "Agost"; break;
		case "September": $mes_nom = "Setembre"; break;
		case "October": $mes_nom = "Octubre"; break;
		case "November": $mes_nom = "Novembre"; break;
		case "December": $mes_nom = "Desembre"; break;
	}
	
	$mesSeguent = mktime(0,0,0,$mes + 1,1,$any);
	$mesAnterior = mktime(0,0,0,$mes - 1,1,$any);
	print '
	<table witdh="150">
	<tr>
		<td class="titol">
			<a href="javascript:;" 
				onclick="loadHTML(\'calendari-ajax.php?mes='.date('m',$mesAnterior).'-'.date('Y',$mesAnterior).'\',\'calendari\');">&lt;&lt;</a>
		</td>
		<td colspan="5" class="titol">'.$mes_nom.' '.$any.'</td>
		<td class="titol">
			<a href="javascript:;" 
				onclick="loadHTML(\'calendari-ajax.php?mes='.date('m',$mesSeguent).'-'.date('Y',$mesSeguent).'\',\'calendari\');">&gt;&gt;</a>
		</td>
	</tr>
	';
	
	$setmana = (date('D',$time) == "Sun") ? -1 : 0;
	for ($i = $setmana; $i < 6; $i++) {
		print '<tr>';
		for ($j = 1; $j <= 7; $j++) {
			$dayNum = $j + $i*7 - $date['wday'] + 1;
			if ($dayNum > 0 && $dayNum <= $dayTotal) {
				miradia($dayNum,$mes,$any);
			} else {
				echo '<td class="normal"></td>';
			}
		}
		print '</tr>';
		if ($dayNum >= $dayTotal && $i != 6) break;
	}
	print '</table>';
}

?>