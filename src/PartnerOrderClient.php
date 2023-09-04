<?php

/**
 * PartnerProductClient File Doc Comment
 * php version 7.4.15
 *
 * @license https://opensource.org/licenses/Apache-2.0 Apache-2.0
 * @link    https://public-docs.live.api.otto.market/03_Products/v1/orders-interface.html
 */

namespace Thecodebunny\OttoApi;

use Thecodebunny\OttoApi\Oauth2\Oauth2ApiAccessor;
use Thecodebunny\OttoApi\Products\ObjectSerializer;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\LoggerInterface;

/**
 * PartnerQuantityClient class is a PHP client for the OTTO Market Products API.
 *
 * @license https://opensource.org/licenses/Apache-2.0 Apache-2.0
 */
class PartnerOrderClient
{
    private const API_VERSION   = "/v4";
    private const ORDERS_PATH = "orders";

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
        $logger->debug("Creating new client for partner orders");
        $this->configuration = $configuration;
        $this->logger        = $logger;
        $this->accessor      = $accessor;
    }

    /**
     * Get all product from defined request
     *
     * @param string|null $sku              search parameter sku
     * @param string|null $productReference search parameter productReference
     * @param string|null $category         search parameter category
     * @param string|null $brand            search parameter brand
     *
     * @return ProductVariation[] an array of all found orders.
     *
     * @throws ClientExceptionInterface on HTTP client exception
     * @throws Oauth2\Oauth2Exception on token refresh exception
     *
     * @psalm-suppress InvalidReturnType
     * @psalm-suppress InvalidReturnStatement
     */
    public function getProducts(
        ?string $sku = null,
        ?string $productReference = null,
        ?string $category = null,
        ?string $brand = null
    ): array {
        $nextLink = implode("/", [self::API_VERSION, self::ORDERS_PATH]);
        $nextLink = $this->buildProductsLinkFromParameter($nextLink, $sku, $productReference, $category, $brand);

        $listOfProductVariations = [];

        while (!is_null($nextLink)) {
            $this->logger->debug($nextLink);
            $response = $this->accessor->get($nextLink);

            $data = json_decode($response->getBody()->getContents());

            foreach ($data->productVariations as $variation) {
                /*
                 * @var ProductVariation $productVariation
                 */
                $productVariation = ObjectSerializer::deserialize(
                    $variation,
                    "\Thecodebunny\OttoApi\Products\Model\ProductVariation"
                );
                array_push($listOfProductVariations, $productVariation);
            }

            $nextLink = null;
            foreach ($data->links as $link) {
                if ($link->rel == 'next') {
                    $nextLink = $link->href;
                    $this->logger->debug("Accessing next product link " . $link->href);
                }
            }
        }//end while

        return $listOfProductVariations;
    }

    /**
     * Builds all needed parameters to working http path
     *
     * @param  string      $nextLink
     * @param  string|null $sku
     * @param  string|null $productReference
     * @param  string|null $category
     * @param  string|null $brand
     * @return string
     */
    private function buildProductsLinkFromParameter(
        string $nextLink,
        ?string $sku,
        ?string $productReference,
        ?string $category,
        ?string $brand
    ): string {
        if (!empty($sku)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&sku=' . $sku;
            } else {
                $nextLink = $nextLink . '?sku=' . $sku;
            }
        }

        if (!empty($productReference)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&productReference=' . $productReference;
            } else {
                $nextLink = $nextLink . '?productReference=' . $productReference;
            }
        }

        if (!empty($category)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&category=' . $category;
            } else {
                $nextLink = $nextLink . '?category=' . $category;
            }
        }

        if (!empty($brand)) {
            if (strpos($nextLink, '?') !== false) {
                $nextLink = $nextLink . '&brand=' . $brand;
            } else {
                $nextLink = $nextLink . '?brand=' . $brand;
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
