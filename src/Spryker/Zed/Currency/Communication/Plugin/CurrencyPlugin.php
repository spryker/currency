<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Communication\Plugin;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\Currency\Business\CurrencyFacadeInterface getFacade()
 * @method \Spryker\Zed\Currency\CurrencyConfig getConfig()
 * @method \Spryker\Zed\Currency\Communication\CurrencyCommunicationFactory getFactory()
 */
class CurrencyPlugin extends AbstractPlugin implements CurrencyPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $isoCode
     *
     * @return \Generated\Shared\Transfer\CurrencyTransfer
     */
    public function fromIsoCode($isoCode)
    {
        return $this->getFacade()->fromIsoCode($isoCode);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\CurrencyTransfer
     */
    public function getCurrent()
    {
        return $this->getFacade()->getCurrent();
    }
}
