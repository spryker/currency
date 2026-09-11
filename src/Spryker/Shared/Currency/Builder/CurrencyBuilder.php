<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Currency\Builder;

use Generated\Shared\Transfer\CurrencyTransfer;
use Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationInterface;

class CurrencyBuilder implements CurrencyBuilderInterface
{
    /**
     * @var array<string, \Generated\Shared\Transfer\CurrencyTransfer>
     */
    protected static array $currencyTransfersCache = [];

    /**
     * @var \Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationInterface
     */
    protected $currencyRepository;

    /**
     * @var string
     */
    protected $defaultIsoCode;

    /**
     * @var string
     */
    protected $currentCurrencyIsoCode;

    public function __construct(
        CurrencyToInternationalizationInterface $currencyRepository,
        string $defaultIsoCode,
        string $currentCurrencyIsoCode
    ) {
        $this->currencyRepository = $currencyRepository;
        $this->defaultIsoCode = $defaultIsoCode;
        $this->currentCurrencyIsoCode = $currentCurrencyIsoCode;
    }

    public function fromIsoCode(string $isoCode): CurrencyTransfer
    {
        $cacheKey = $this->getCacheKey($isoCode);

        if (!isset(static::$currencyTransfersCache[$cacheKey])) {
            $currencyTransfer = new CurrencyTransfer();
            $currencyTransfer->setCode($isoCode);
            $currencyTransfer->setName($this->currencyRepository->getNameByIsoCode($isoCode));
            $currencyTransfer->setSymbol($this->currencyRepository->getSymbolByIsoCode($isoCode));
            $currencyTransfer->setIsDefault($isoCode === $this->defaultIsoCode);
            $currencyTransfer->setFractionDigits($this->currencyRepository->getFractionDigits($isoCode));

            static::$currencyTransfersCache[$cacheKey] = $currencyTransfer;
        }

        return clone static::$currencyTransfersCache[$cacheKey];
    }

    protected function getCacheKey(string $isoCode): string
    {
        return $isoCode . ':' . $this->defaultIsoCode;
    }

    public function getCurrent(): CurrencyTransfer
    {
        return $this->fromIsoCode($this->currentCurrencyIsoCode);
    }
}
