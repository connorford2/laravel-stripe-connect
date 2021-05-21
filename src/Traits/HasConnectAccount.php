<?php

namespace ConnorFord2\StripeConnect\Traits;

trait HasConnectAccount
{
    use ManagesConnectAccount;
    use ManagesExternalAccounts;
    use Transferrable;
    use Debitable;
}


