<?php

$hash = 'sha256';

try
{
    	$bdd = new PDO('mysql:host=localhost;dbname=Site_projet_final;charset=utf8', 'Utilisateur', 'WebCodeMdpdkazdg',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
    {
    	die('Erreur : '.$e->getMessage());
    }
