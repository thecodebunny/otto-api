<?php

/**
 * PartnerQuantityClient File Doc Comment
 * php version 7.4.15
 *
 * @license https://opensource.org/licenses/Apache-2.0 Apache-2.0
 * @link    https://public-docs.live.api.otto.market/03_Products/v1/products-interface.html
 */

namespace Thecodebunny\OttoApi;

use Thecodebunny\OttoApi\Oauth2\Oauth2ApiAccessor;
use Thecodebunny\OttoApi\Quantities\ObjectSerializer;
use Thecodebunny\OttoApi\Products\Model\ProductProcessProgress;
use Thecodebunny\OttoApi\Products\Model\ProductProcessResultLink;
use Thecodebunny\OttoApi\Quantities\Model\QuantityVariation;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\LoggerInterface;

/**
 * PartnerQuantityClient class is a PHP client for the OTTO Market Products API.
 * See https://hemangvyas.comdocs/03_Products/v2/products-interface.html
 *
 * @license https://opensource.org/licenses/Apache-2.0 Apache-2.0
 * @link    https://hemangvyas.comdocs/03_Products/v2/products-interface.html
 */
class PartnerQuantityClient
{
    private const API_VERSION   = "/v2";
    private const QUANTITIES_PATH = "quantities";

    /**
     * the maximum amount of product variants that can be sent in one POST request
     */
    private const MAX_PRODUCT_POST_SIZE = 500;

    /**
     * The client configuration.
     *
     * @var Configuration The configuration object.
     */
    private Configuration $configuration;

    /**
     * The logger to use.
     *
     * @var LoggerInterface The logger to use.
     */
    private LoggerInterface $logger;

    /**
     * The secured resources accessor.
     *
     * @var Oauth2ApiAccessor The accessor to use.
     */
    private Oauth2ApiAccessor $accessor;

    /**
     * Create a new client.
     *
     * @param Configuration     $configuration the client configuration.
     * @param LoggerInterface   $logger        the logger that should be used
     *                                         by the client.
     * @param Oauth2ApiAccessor $accessor      needed to access the secured
     *                                         resources.
     */
    public function __construct(Configuration $configuration, LoggerInterface $logger, Oauth2ApiAccessor $accessor)
    {
        $logger->debug("Creating new client for partner quantities");
        $this->configuration = $configuration;
        $this->logger        = $logger;
        $this->accessor      = $accessor;
    }

    /**
     * Get all product from defined request
     * @param int|null $limit search parameter productReference
     * @param int|null $page         search parameter category
     * @param string|null $cursor            search parameter brand
     *
     * @return QuantityVariation[] an array of all found products.
     *
     * @throws ClientExceptionInterface on HTTP client exception
     * @throws Oauth2\Oauth2Exception on token refresh exception
     *
     * @psalm-suppress InvalidReturnType
     * @psalm-suppress InvalidReturnStatement
     */
    public function getAvailableQuantities(
        ?int $limit = 200,
        ?int $page = null,
        ?string $cursor = null
    ): array {
        $nextLink = implode("/", [self::API_VERSION, self::QUANTITIES_PATH]);
        $nextLink = $this->buildQuantitiesLinkFromParameter($nextLink, $limit, $page, $cursor);

        $listOfQuantityVariations = [];

        while (!is_null($nextLink)) {
            $this->logger->debug($nextLink);
            $response = $this->accessor->get($nextLink);

            $data = json_decode($response->getBody()->getContents());
            dump($data->resources);
            foreach ($data->resources->variations as $variation) {
                /*
                 * @var QuantityVariation $quantityVariation
                 */
                $quantityVariation = ObjectSerializer::deserialize(
                    $variation,
                    "\Thecodebunny\OttoApi\Quantities\Model\QuantityVariation"
                );
                array_push($listOfQuantityVariations, $quantityVariation);
            }

            $nextLink = null;
            foreach ($data->links as $link) {
                if ($link->rel == 'next') {
                    $nextLink = $link->href;
                    $this->logger->debug("Accessing next product link " . $link->href);
                }
            }
        }//end while

        return $listOfQuantityVariations;
    }

    /**
     * Builds all needed parameters to working http path
     *
     * @param  string      $nextLink
     */
    private function buildQuantitiesLinkFromParameter(
        string $nextLink,
        ?string $cursor
    ): string {

        if (!empty($limit)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&limit=' . $limit;
            } else {
                $nextLink = $nextLink . '?limit=' . $limit;
            }
        }

        if (!empty($page)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&page=' . $page;
            } else {
                $nextLink = $nextLink . '?page=' . $page;
            }
        }

        if (!empty($cursor)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&cursor=' . $cursor;
            } else {
                $nextLink = $nextLink . '?cursor=' . $cursor;
            }
        }

        return $nextLink;
    }

    /**
     * Searches for the first link with the specified relation tag and returns
     * the href of this link. If no link could be found null is returned.
     *
     * @param ProductProcessResultLink[] $links the array of links that should be searched.
     * @param string                     $rel   the relation tag that is sought.
     *
     * @return string the first links href value or null.
     */
    private static function getLink(array $links, string $rel): ?string
    {
        if ($links != null) {
            $nextLink = array_filter(
                $links,
                function ($e) use (&$rel) {
                    return $e->getRel() == $rel;
                }
            );
            if (!empty($nextLink) > 0) {
                return $nextLink[0]->getHref();
            }
        }

        return null;
    }
}
