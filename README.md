# DGFIP Datamatrix

Way to generate, in PHP, a [datamatrix for DGFIP](https://www.collectivites-locales.gouv.fr/files/Finances%20locales/2.%20am%C3%A9liorer%20l'info%20et%20gestion/3.%20d%C3%A9mat%20comptable%20et%20bdgr/PES/PES_V2/fiches%20pratiques/recettes/cahier_des_charges_editeurs.v6_0.pdf) (French tax administration).


## Installation

With composer:

```bash
composer require bluspark/dgfip-datamatrix
```

## Usage

```php

use Bluspark\DgfipDatamatrix\DataMatrixGenerator;
use Bluspark\DgfipDatamatrix\DataMatrixReference;

$reference = new DataMatrixReference();
$reference
    ->setEmitterCode("...")
    ->setEstablishmentCode("...")
    ->setRevenueCode("...")
    ->setAccountanceCode("...")
    ->setPeriodCode("...");

$generator = new DataMatrixGenerator();
$datamatrix = $generator->generate($reference);


echo "The datamatrix code is: " . $datamatrix->asString();
```

### Generating images

If you want to generate an image of the datamatrix, we suggest you to install the `jucksearm\\barcode` package:

```bash
composer require jucksearm/barcode
```

Then you can generate the image like this:

```php
// For a PNG image
$png = $datamatrix->asPng();
file_put_contents("datamatrix.png", $png);

// For a SVG image
$svg = $datamatrix->asSvg();
file_put_contents("datamatrix.svg", $svg);
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Sponsors

![Bluspark logo](./docs/bluspark_logo.jpeg)

Bluspark is a Saas application to operate infrastructure of agglomerations and cities. It is a complete solution to manage the life cycle of your infrastructure, from the design to the maintenance.