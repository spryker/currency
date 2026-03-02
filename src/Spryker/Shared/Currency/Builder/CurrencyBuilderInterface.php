<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Currency\Builder;

use Generated\Shared\Transfer\CurrencyTransfer;

interface CurrencyBuilderInterface
{
    public function fromIsoCode(string $isoCode): CurrencyTransfer;

    public function getCurrent(): CurrencyTransfer;
}
