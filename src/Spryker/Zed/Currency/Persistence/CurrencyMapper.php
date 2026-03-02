<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Persistence;

use Generated\Shared\Transfer\CurrencyTransfer;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationInterface;

class CurrencyMapper
{
    /**
     * @var \Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationInterface
     */
    protected $currencyInternationalization;

    public function __construct(CurrencyToInternationalizationInterface $currencyInternationalization)
    {
        $this->currencyInternationalization = $currencyInternationalization;
    }

    public function mapCurrencyEntityToCurrencyTransfer(
        SpyCurrency $currencyEntity,
        CurrencyTransfer $currencyTransfer
    ): CurrencyTransfer {
        $currencyTransfer->fromArray($currencyEntity->toArray(), true);

        $code = $currencyEntity->getCode();

        if ($code === null) {
            return $currencyTransfer;
        }

        $fractionDigits = $this->currencyInternationalization->getFractionDigits($code);

        return $currencyTransfer->setFractionDigits($fractionDigits);
    }

    public function mapCurrencyTransferToCurrencyEntity(
        CurrencyTransfer $currencyTransfer,
        SpyCurrency $currencyEntity
    ): SpyCurrency {
        $currencyEntity->fromArray($currencyTransfer->toArray());

        return $currencyEntity;
    }
}
