<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Currency\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Yves\Currency\CurrencyFactory getFactory()
 * @method \Spryker\Client\Currency\CurrencyClientInterface getClient()
 */
class CurrencySwitchController extends AbstractController
{
    /**
     * @var string
     */
    public const URL_PARAM_CURRENCY_ISO_CODE = 'currency-iso-code';

    /**
     * @var string
     */
    public const URL_PARAM_REFERRER_URL = 'referrer-url';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request): RedirectResponse
    {
        $currencyIsoCode = $request->get(static::URL_PARAM_CURRENCY_ISO_CODE);
        $this->getClient()->setCurrentCurrencyIsoCode($currencyIsoCode);

        return $this->redirectResponseExternal(
            urldecode($request->get(static::URL_PARAM_REFERRER_URL)),
        );
    }
}
