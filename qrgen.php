<?php // Usiamo la libreria 
require("./phpqrcode/qrlib.php");

// ECC Level, livello di correzione dell'errore (valori possibili in ordine crescente: L,M,Q,H - da low a high)
$errorCorrectionLevel = 'L';

// Matrix Point Size, dimensione dei punti della matrice (da 1 a 10)
$matrixPointSize = 4;

// Il File da salvare (deve essere salvato in una directory scrivibile dal web server)


// Generiamo il QRcode in formato immagine PNG


function qrgen($data){
    
    $filename = 'qrcode'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    return $filename;
}
?>