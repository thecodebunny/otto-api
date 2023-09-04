<?php
/**
 * MarketPlaceStatus
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  Thecodebunny\OttoApi\Products
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Public Partner Product API
 *
 * Manage your product data, send images and                   much more.
 *
 * The version of the OpenAPI document: V2
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.1.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Thecodebunny\OttoApi\Products\Model;

use \ArrayAccess;
use \Thecodebunny\OttoApi\Products\ObjectSerializer;

/**
 * MarketPlaceStatus Class Doc Comment
 *
 * @category Class
 * @package  Thecodebunny\OttoApi\Products
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class MarketPlaceStatus implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MarketPlaceStatus';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'sku' => 'string',
        'status' => 'string',
        'errors' => '\Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusError[]',
        'information' => '\Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusInformation[]',
        'links' => '\Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusLink[]',
        'lastModified' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'sku' => null,
        'status' => null,
        'errors' => null,
        'information' => null,
        'links' => null,
        'lastModified' => 'date-time'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'sku' => 'sku',
        'status' => 'status',
        'errors' => 'errors',
        'information' => 'information',
        'links' => 'links',
        'lastModified' => 'lastModified'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'sku' => 'setSku',
        'status' => 'setStatus',
        'errors' => 'setErrors',
        'information' => 'setInformation',
        'links' => 'setLinks',
        'lastModified' => 'setLastModified'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'sku' => 'getSku',
        'status' => 'getStatus',
        'errors' => 'getErrors',
        'information' => 'getInformation',
        'links' => 'getLinks',
        'lastModified' => 'getLastModified'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const STATUS_PENDING = 'PENDING';
    const STATUS_ONLINE = 'ONLINE';
    const STATUS_RESTRICTED = 'RESTRICTED';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_INACTIVE = 'INACTIVE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ONLINE,
            self::STATUS_RESTRICTED,
            self::STATUS_REJECTED,
            self::STATUS_INACTIVE,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['sku'] = $data['sku'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['errors'] = $data['errors'] ?? null;
        $this->container['information'] = $data['information'] ?? null;
        $this->container['links'] = $data['links'] ?? null;
        $this->container['lastModified'] = $data['lastModified'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets sku
     *
     * @return string|null
     */
    public function getSku()
    {
        return $this->container['sku'];
    }

    /**
     * Sets sku
     *
     * @param string|null $sku Partner-unique identifier for a product variation provided by the partner
     *
     * @return self
     */
    public function setSku($sku)
    {
        $this->container['sku'] = $sku;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status the status of the variation on the OTTO market place
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets errors
     *
     * @return \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusError[]|null
     */
    public function getErrors()
    {
        return $this->container['errors'];
    }

    /**
     * Sets errors
     *
     * @param \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusError[]|null $errors errors that occurred when processing the variation
     *
     * @return self
     */
    public function setErrors($errors)
    {
        $this->container['errors'] = $errors;

        return $this;
    }

    /**
     * Gets information
     *
     * @return \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusInformation[]|null
     */
    public function getInformation()
    {
        return $this->container['information'];
    }

    /**
     * Sets information
     *
     * @param \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusInformation[]|null $information information for product optimization on the OTTO market place
     *
     * @return self
     */
    public function setInformation($information)
    {
        $this->container['information'] = $information;

        return $this;
    }

    /**
     * Gets links
     *
     * @return \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusLink[]|null
     */
    public function getLinks()
    {
        return $this->container['links'];
    }

    /**
     * Sets links
     *
     * @param \Thecodebunny\OttoApi\Products\Model\MarketPlaceStatusLink[]|null $links contains the link to the partner variation data and to the product in OTTO shop
     *
     * @return self
     */
    public function setLinks($links)
    {
        $this->container['links'] = $links;

        return $this;
    }

    /**
     * Gets lastModified
     *
     * @return \DateTime|null
     */
    public function getLastModified()
    {
        return $this->container['lastModified'];
    }

    /**
     * Sets lastModified
     *
     * @param \DateTime|null $lastModified last change of the marketplace status
     *
     * @return self
     */
    public function setLastModified($lastModified)
    {
        $this->container['lastModified'] = $lastModified;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


