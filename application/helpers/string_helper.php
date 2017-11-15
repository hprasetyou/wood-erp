<?php

function string($index,$file="default"){
	$string = include("application/language/en/$file.php");
	return $string[$index];
}
