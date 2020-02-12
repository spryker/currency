<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Business;

use Spryker\Shared\Currency\Builder\CurrencyBuilder;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Currency\Business\Reader\CurrencyIsoCodeReader;
use Spryker\Zed\Currency\Business\Reader\CurrencyIsoCodeReaderInterface;
use Spryker\Zed\Currency\CurrencyDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CurrencyBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return \Spryker\Shared\Currency\Builder\CurrencyBuilderInterface
     */
    public function createCurrencyBuilder()
    {
        return new CurrencyBuilder(
            $this->getInternationalization(),
            $this->getStore()->getCurrencyIsoCode()
        );
    }

    /**
     * @return \Spryker\Zed\Currency\Business\Reader\CurrencyIsoCodeReaderInterface
     */
    public function createCurrencyIsoCodeReader(): CurrencyIsoCodeReaderInterface
    {
        return new CurrencyIsoCodeReader($this->getStore());
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getStore()
    {
        return $this->getProvidedDependency(CurrencyDependencyProvider::STORE);
    }

    /**
     * @return \Spryker\Shared\Currency\Dependency\Internationalization\CurrencyToInternationalizationInterface
     */
    protected function getInternationalization()
    {
        return $this->getProvidedDependency(CurrencyDependencyProvider::INTERNATIONALIZATION);
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore(): Store
    {
        return $this->getProvidedDependency(CurrencyDependencyProvider::STORE);
    }

}
