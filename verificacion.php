<?php

use PragmaRX\Google2FA\Google2FA;

require __DIR__ . '/vendor/autoload.php';

$secretoguardado = "";
$ingresado = "012314";

$google2fa = new Google2FA();
$isValid = $google2fa->verifyKey($secretoguardado, $ingresado);

if ($isValid) {
    // Autenticación 2FA exitosa
    echo "2FA verificado correctamente.";
} else {
    // Código incorrecto
    echo "Código 2FA incorrecto. Inténtalo de nuevo.";
}