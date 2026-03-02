<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Communication\Plugin\Twig;

use Generated\Shared\Transfer\CurrencyTransfer;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Twig\Environment;
use Twig\TwigFunction;

/**
 * @method \Spryker\Zed\Currency\CurrencyConfig getConfig()
 * @method \Spryker\Zed\Currency\Business\CurrencyFacadeInterface getFacade()
 * @method \Spryker\Zed\Currency\Communication\CurrencyCommunicationFactory getFactory()
 */
class CurrencyTwigPlugin extends AbstractPlugin implements TwigPluginInterface
{
    /**
     * @var string
     */
    protected const NO_SYMBOL_FOUND = '-';

    /**
     * @var string
     */
    protected const CURRENCY_SYMBOL_FUNCTION_NAME = 'currencySymbol';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Twig\Environment $twig
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Twig\Environment
     */
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig->addFunction($this->getCurrencySymbolFunction());

        return $twig;
    }

    protected function getCurrencySymbolFunction(): TwigFunction
    {
        return new TwigFunction(static::CURRENCY_SYMBOL_FUNCTION_NAME, function (?string $isoCode = null) {
            return $this->getCurrencySymbol($isoCode);
        });
    }

    protected function getCurrencySymbol(?string $isoCode = null): string
    {
        $currencyTransfer = $this->getCurrencyTransfer($isoCode);
        if ($currencyTransfer->getSymbol() !== null) {
            return $currencyTransfer->getSymbol();
        }

        return static::NO_SYMBOL_FOUND;
    }

    protected function getCurrencyTransfer(?string $isoCode = null): CurrencyTransfer
    {
        if ($isoCode !== null) {
            return $this->getFacade()->fromIsoCode($isoCode);
        }

        return $this->getFacade()->getCurrent();
    }
}
