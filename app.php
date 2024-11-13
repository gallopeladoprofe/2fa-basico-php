<?php
// https://github.com/endroid/qr-code
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use PragmaRX\Google2FA\Google2FA;

$google2fa = new Google2FA();
$secretKey = $google2fa->generateSecretKey();

$userEmail = '';

// generar qr
$qrCodeUrl = $google2fa->getQRCodeUrl(
    'AppPrueba'
    , $userEmail
    , $secretKey
);

// Genera el código QR
$builder = new Builder(
    writer: new PngWriter(),
    writerOptions: [],
    validateResult: false,
    data: $qrCodeUrl,
    encoding: new Encoding('UTF-8'),
    errorCorrectionLevel: ErrorCorrectionLevel::High,
    size: 300,
    margin: 10,
    roundBlockSizeMode: RoundBlockSizeMode::Margin,
    //logoPath: __DIR__.'/assets/symfony.png',
    logoResizeToWidth: 50,
    logoPunchoutBackground: true,
    labelText: 'This is the label',
    labelFont: new OpenSans(20),
    labelAlignment: LabelAlignment::Center
);
$result = $builder->build();

echo var_dump($secretKey);

echo '<hr>';

echo "<img src={$result->getDataUri()} />";
