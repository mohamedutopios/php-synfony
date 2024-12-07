<div>HTML DANS PHP</div>
<?php
    

    define("CONSTANTE", "VALUE CONSTANTE");
    $nom = 'abadi';
    // $a = 10.0;
    // $b = 10;
    // $test = true;
    // echo gettype($nom)."\n";
    // echo gettype($a)."\n";
    // echo gettype(($b + $a))."\n";
    // echo gettype($test)."\n";

    // echo CONSTANTE;

    // foreach(str_split($nom) as $k =>$c) {
    //     echo $k. " => ".$c."\n";
    // }

    echo carre(10)."\n";

    function carre(?int $nombre):?int {
        return $nombre * $nombre;
    }

    $tab = [1,2, "test"];
    array_push($tab, "toto", "tata");
    var_dump($tab);

    $tab = [
        "key" => "value 1",
        true => "value of true",
        30 => "value of 30"
    ];

    var_dump($tab);

    $n = readline("Merci de saisir une valeur : ");
    
?>