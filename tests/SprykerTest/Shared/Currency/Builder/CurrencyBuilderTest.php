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

    public function testConstruct(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();
        $this->assertInstanceOf(CurrencyBuilderInterface::class, $currencyBuilder);
    }

    public function testFromIsoCodeShouldReturnCurrencyTransfer(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();

        $currencyTransfer = $currencyBuilder->fromIsoCode(static::DEFAULT_CURRENCY);
        $this->assertSame(static::DEFAULT_CURRENCY, $currencyTransfer->getCode());
    }

    public function testFromIsoCodeReturnsFreshCloneOnEachCallSoCallersCannotMutateTheCache(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();

        $firstCurrencyTransfer = $currencyBuilder->fromIsoCode(static::CURRENT_CURRENCY);
        $firstCurrencyTransfer->setName('mutated');

        $secondCurrencyTransfer = $currencyBuilder->fromIsoCode(static::CURRENT_CURRENCY);

        $this->assertNotSame($firstCurrencyTransfer, $secondCurrencyTransfer);
        $this->assertNotSame('mutated', $secondCurrencyTransfer->getName());
    }

    public function testFromIsoCodeReturnsEqualDataForCachedAndUncachedCalls(): void
    {
        $currencyBuilder = $this->getCurrencyBuilder();

        $uncachedCurrencyTransfer = $currencyBuilder->fromIsoCode(static::DEFAULT_CURRENCY);
        $cachedCurrencyTransfer = $currencyBuilder->fromIsoCode(static::DEFAULT_CURRENCY);

        $this->assertEquals($uncachedCurrencyTransfer, $cachedCurrencyTransfer);
        $this->assertTrue($cachedCurrencyTransfer->getIsDefault());
    }

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
