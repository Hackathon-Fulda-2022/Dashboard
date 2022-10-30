<?php 

function alter( $datum )
{
  $geburtstag = new DateTime($datum);
  $heute = new DateTime(date('d.m.Y'));
  $differenz = $geburtstag->diff($heute);
 
  return $differenz->format('%y');
}

?>