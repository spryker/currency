<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Dependency\Facade;

interface CurrencyToStoreInterface
{

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer[]
     */
    public function getAllActiveStores();

    /**
     * @return string
     */
    public function getCurrencyIsoCode();

    /**
     * @return array
     */
    public function getCurrencyIsoCodes();

    /**
     * @param string $storeName
     *
     * @return array
     */
    public function getAvailableCurrenciesForStore($storeName);

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore();

}
