<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Currency\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Currency\Communication\CurrencyCommunicationFactory getFactory()
 * @method \Spryker\Zed\Currency\Persistence\CurrencyQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Currency\Persistence\CurrencyRepositoryInterface getRepository()
 * @method \Spryker\Zed\Currency\Business\CurrencyFacadeInterface getFacade()
 */
class CurrenciesForStoreController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        $idStore = $this->castId($request->request->get('idStore'));
        $storeWithCurrenciesCollection = $this->getFactory()
            ->createStoreWithCurrenciesCollectionBuilder()
            ->buildStoreWithCurrenciesCollectionByStoreId($idStore);

        return $this->jsonResponse($storeWithCurrenciesCollection);
    }
}
