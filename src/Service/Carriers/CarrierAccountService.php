<?php declare(strict_types=1);

namespace ShipEngine\Service\Carriers;

use Psr\Http\Client\ClientExceptionInterface;
use ShipEngine\Model\Carriers\CarrierAccount;
use ShipEngine\ShipEngineClient;
use ShipEngine\ShipEngineConfig;
use ShipEngine\Util\Constants\RPCMethods;

/**
 * Class CarrierAccountService
 *
 * @package ShipEngine\Service\Carriers
 */
final class CarrierAccountService
{
    /**
     * Cached list of carrier accounts if any are present.
     *
     * @var array
     */
    public array $accounts;

    /**
     * Get all carrier accounts for a given ShipEngine account.
     *
     * @param ShipEngineConfig $config
     * @return array
     * @throws ClientExceptionInterface
     */
    public function fetchCarrierAccounts(ShipEngineConfig $config): array
    {
        $client = new ShipEngineClient();

        if (count($this->accounts) > 0) {
            return $this->accounts;
        }

        $api_response = $client->request(
            RPCMethods::LIST_CARRIER_ACCOUNTS,
            $config
        );

        $accounts = $api_response['result']['carrier_accounts'];
        $this->accounts = array();
        foreach ($accounts as $account) {
            $carrier_account = new CarrierAccount($account);
            $this->accounts[] = $carrier_account;
        }

        return $this->accounts;
    }
}
