<?php

$array = [];

$text = "Bonjour et au revoir ! Je m'appelle John Doe, j'ai 27 ans, j'habite en France et travaille depuis que j'ai 20 ans. Ma passion : écrire des mots, mits, mets, mats, mat... Pour me contacter, vous pouvez envoyer un email à contact@johndoe.fr ou contact@johndoe.com ou bien m'appeler au 06 07 08 09 10. Vous pouvez aussi aller voir mon blog à l'adresse johndoe-blog.fr. Bonjour et au revoir";

 
var_dump(preg_match("#^Bonjour#", $text));

var_dump(preg_match("#revoir$#", $text));

var_dump(preg_match("#Bonjour|revoir#", $text)); 

var_dump(preg_match("#^Bonjour|revoir$#", $text)); 

var_dump(preg_match_all("#m[oai]ts#", $text, $array)); 
var_dump($array);

var_dump(preg_match("#m[^oai]ts#", $text)); 

var_dump(preg_match_all("#m\wts#", $text));

var_dump(preg_match_all("#.#", $text));

//Les quantificateurs

var_dump(preg_match_all("#[a-zA-Z]{6}#", $text));

var_dump(preg_match_all("#[0-9]{2,4}#", $text));
//----------------------------------------------------------------------------

var_dump(preg_match_all("#(0|\+33)[1-9]( *[0-9]{2}){4}#", $text, $array));
var_dump($array);


$numero = "0405060708";
if (preg_match('#(0|\+33)[1-9]( *[0-9]{2}){4}#', $numero)) {
    echo "Le numéro de téléphone entré est correct.";
    // On peut ajouter le numéro à la base de donnée
} else {
    echo "Le numéro de téléphone entré est incorrect.";
    // On ne peut pas ajouter le numéro à la base de donnée
}
//----------------------------------------------------------------------------

$prenom = ["Martin", "Bernard", "Thomas", "Robert", "Richard", "Simon", "Laurent", "Mathieu", "Michel", "Clement"];

foreach(preg_match('#^([A-Z]|[a-z]) + (ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ)+$#' as $prenom)) {
    
    var_dump($prenom);
};










?>