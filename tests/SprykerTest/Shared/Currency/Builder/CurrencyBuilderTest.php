<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\Currency\Builder;

use Codeception\Test\Unit;
use Spryker\Shared\Currency\Builder\CurrencyBuilder;
use Spryker\Shared\Currency\Builder\CurrencyBuilderInterface;
use Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationBridge;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Shared
 * @group Currency
 * @group Builder
 * @group CurrencyBuilderTest
 * Add your own group annotations below this line
 */
class CurrencyBuilderTest extends Unit
{
    /**
     * @var string
     */
    public const DEFAULT_CURRENCY = 'EUR';

    /**
     * @var string
     */
    public const CURRENT_CURRENCY = 'USD';

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();
        $this->assertInstanceOf(CurrencyBuilderInterface::class, $currencyBuilder);
    }

    /**
     * @return void
     */
    public function testFromIsoCodeShouldReturnCurrencyTransfer(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();

        $currencyTransfer = $currencyBuilder->fromIsoCode(static::DEFAULT_CURRENCY);
        $this->assertSame(static::DEFAULT_CURRENCY, $currencyTransfer->getCode());
    }

    /**
     * @return \Spryker\Shared\Currency\Builder\CurrencyBuilderInterface
     */
    protected function getCurrencyBuilder(): CurrencyBuilderInterface
    {
        $currencyRepository = new CurrencyToInternationalizationBridge();

        return new CurrencyBuilder(
            $currencyRepository,
            static::DEFAULT_CURRENCY,
            static::CURRENT_CURRENCY,
        );
    }
}
