<?php

// $now = date("Y-m-d H:i:s");
// var_dump($now);

$today = new DateTimeImmutable("now", new DateTimeZone("europe/Paris"));
var_dump($today);

$annee_courante = $today->format("Y");
$mois_courant = $today->format("m");
$jour_courant = $today->format("d");

echo "Nous sommes le $jour_courant/$mois_courant/$annee_courante";

$jour = $today->modify("Monday next week");
var_dump($jour);

$jour = $today->modify("+31 day");
var_dump($jour);

$jour = $today->modify("first day of");
var_dump($jour);
$jour = $today->modify("last day of");
var_dump($jour);

$jour = $today->modify("first day of next month");
var_dump($jour);

$jour = $today->modify("first day of January 2021");
var_dump($jour);

$jour = $today->modify("last monday");
var_dump($jour);

$premier_lundi = $now->modify("first monday of");

$premier_mois_suivant = $premier->modify("+ 1 month");

$dernier = $premier->modify("+ 1 month - 1 day");

$premier_annee_suivante = $now->modify("first day of January + 1 year");

$premier_lundi_precedent = ((int) $premier_lundi->format("d") === 01)? $premier_lundi : $premier_lundi->modify("last monday");





 