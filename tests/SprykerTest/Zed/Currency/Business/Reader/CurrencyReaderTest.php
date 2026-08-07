<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Currency\Business\Reader;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Currency\Business\Reader\CurrencyReader;
use Spryker\Zed\Currency\Dependency\Facade\CurrencyToStoreFacadeInterface;
use Spryker\Zed\Currency\Persistence\CurrencyRepository;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group Currency
 * @group Business
 * @group Reader
 * @group CurrencyReaderTest
 * Add your own group annotations below this line
 */
class CurrencyReaderTest extends Unit
{
    /**
     * @var string
     */
    protected const STORE_NAME_FIRST = 'CURRENCY_READER_STORE_ONE';

    /**
     * @var string
     */
    protected const STORE_NAME_SECOND = 'CURRENCY_READER_STORE_TWO';

    /**
     * @var string
     */
    protected const EUR_ISO_CODE = 'EUR';

    /**
     * @var string
     */
    protected const USD_ISO_CODE = 'USD';

    /**
     * @var string
     */
    protected const GBP_ISO_CODE = 'GBP';

    /**
     * @var \SprykerTest\Zed\Currency\CurrencyBusinessTester
     */
    protected $tester;

    public function testGetAllStoresWithCurrenciesAssignsOnlyOwnCurrenciesToEachStore(): void
    {
        // Arrange
        $this->tester->haveCurrency([CurrencyTransfer::CODE => static::EUR_ISO_CODE]);
        $this->tester->haveCurrency([CurrencyTransfer::CODE => static::USD_ISO_CODE]);
        $this->tester->haveCurrency([CurrencyTransfer::CODE => static::GBP_ISO_CODE]);

        $storeTransfers = [
            (new StoreTransfer())
                ->setName(static::STORE_NAME_FIRST)
                ->setAvailableCurrencyIsoCodes([static::EUR_ISO_CODE]),
            (new StoreTransfer())
                ->setName(static::STORE_NAME_SECOND)
                ->setAvailableCurrencyIsoCodes([static::USD_ISO_CODE, static::GBP_ISO_CODE]),
        ];

        // Act
        $storeWithCurrencyTransfers = $this->createCurrencyReader($storeTransfers)->getAllStoresWithCurrencies();

        // Assert
        $this->assertCount(2, $storeWithCurrencyTransfers);
        $this->assertSame(
            [static::EUR_ISO_CODE],
            $this->getCurrencyIsoCodes($storeWithCurrencyTransfers[0]->getCurrencies()),
        );
        $this->assertSame(
            [static::GBP_ISO_CODE, static::USD_ISO_CODE],
            $this->getCurrencyIsoCodes($storeWithCurrencyTransfers[1]->getCurrencies()),
        );
    }

    public function testGetAllStoresWithCurrenciesSkipsStoresWithoutAvailableCurrencyIsoCodes(): void
    {
        // Arrange
        $this->tester->haveCurrency([CurrencyTransfer::CODE => static::EUR_ISO_CODE]);

        $storeTransfers = [
            (new StoreTransfer())
                ->setName(static::STORE_NAME_FIRST)
                ->setAvailableCurrencyIsoCodes([]),
            (new StoreTransfer())
                ->setName(static::STORE_NAME_SECOND)
                ->setAvailableCurrencyIsoCodes([static::EUR_ISO_CODE]),
        ];

        // Act
        $storeWithCurrencyTransfers = $this->createCurrencyReader($storeTransfers)->getAllStoresWithCurrencies();

        // Assert
        $this->assertCount(1, $storeWithCurrencyTransfers);
        $this->assertSame(static::STORE_NAME_SECOND, $storeWithCurrencyTransfers[0]->getStoreOrFail()->getName());
    }

    /**
     * @param array<\Generated\Shared\Transfer\StoreTransfer> $storeTransfers
     *
     * @return \Spryker\Zed\Currency\Business\Reader\CurrencyReader
     */
    protected function createCurrencyReader(array $storeTransfers): CurrencyReader
    {
        $storeFacadeMock = $this->createMock(CurrencyToStoreFacadeInterface::class);
        $storeFacadeMock->method('getAllStores')->willReturn($storeTransfers);

        return new CurrencyReader($storeFacadeMock, new CurrencyRepository());
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\CurrencyTransfer>|iterable $currencyTransfers
     *
     * @return array<string>
     */
    protected function getCurrencyIsoCodes(iterable $currencyTransfers): array
    {
        $currencyIsoCodes = [];
        foreach ($currencyTransfers as $currencyTransfer) {
            $currencyIsoCodes[] = $currencyTransfer->getCodeOrFail();
        }

        sort($currencyIsoCodes);

        return $currencyIsoCodes;
    }
}
