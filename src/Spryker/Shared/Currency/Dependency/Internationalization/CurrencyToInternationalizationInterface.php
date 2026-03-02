<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Currency\Dependency\Internationalization;

interface CurrencyToInternationalizationInterface
{
    public function getSymbolByIsoCode(string $isoCode): string;

    public function getNameByIsoCode(string $isoCode): string;

    public function getFractionDigits(string $isoCode): ?int;
}
