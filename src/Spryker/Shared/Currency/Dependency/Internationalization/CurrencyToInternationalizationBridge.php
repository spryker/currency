<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Currency\Dependency\Internationalization;

use Symfony\Component\Intl\Currencies;

class CurrencyToInternationalizationBridge implements CurrencyToInternationalizationInterface
{
    public function getSymbolByIsoCode(string $isoCode): string
    {
        return Currencies::getSymbol($isoCode);
    }

    public function getNameByIsoCode(string $isoCode): string
    {
        return Currencies::getName($isoCode);
    }

    public function getFractionDigits(string $isoCode): ?int
    {
        return Currencies::getFractionDigits($isoCode);
    }
}
