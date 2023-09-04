<?php
/**
 * Address
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  Thecodebunny\OttoApi\Shipments
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Shipments
 *
 * This interface describes all endpoints regarding the shipment domain.
 *
 * The version of the OpenAPI document: 1.1.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.1.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Thecodebunny\OttoApi\Shipments\Model;

use \ArrayAccess;
use \Thecodebunny\OttoApi\Shipments\ObjectSerializer;

/**
 * Address Class Doc Comment
 *
 * @category Class
 * @description The warehouse or location from which the shipment will be picked up for final delivery.
 * @package  Thecodebunny\OttoApi\Shipments
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Address implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Address';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'city' => 'string',
        'countryCode' => 'string',
        'zipCode' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'city' => null,
        'countryCode' => null,
        'zipCode' => null
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
        'city' => 'city',
        'countryCode' => 'countryCode',
        'zipCode' => 'zipCode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'city' => 'setCity',
        'countryCode' => 'setCountryCode',
        'zipCode' => 'setZipCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'city' => 'getCity',
        'countryCode' => 'getCountryCode',
        'zipCode' => 'getZipCode'
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
        $this->container['city'] = $data['city'] ?? null;
        $this->container['countryCode'] = $data['countryCode'] ?? null;
        $this->container['zipCode'] = $data['zipCode'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['city'] === null) {
            $invalidProperties[] = "'city' can't be null";
        }
        if ((mb_strlen($this->container['city']) > 60)) {
            $invalidProperties[] = "invalid value for 'city', the character length must be smaller than or equal to 60.";
        }

        if ((mb_strlen($this->container['city']) < 1)) {
            $invalidProperties[] = "invalid value for 'city', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['countryCode'] === null) {
            $invalidProperties[] = "'countryCode' can't be null";
        }
        if (!preg_match("/^[A-Z]{3}$/", $this->container['countryCode'])) {
            $invalidProperties[] = "invalid value for 'countryCode', must be conform to the pattern /^[A-Z]{3}$/.";
        }

        if ($this->container['zipCode'] === null) {
            $invalidProperties[] = "'zipCode' can't be null";
        }
        if ((mb_strlen($this->container['zipCode']) > 10)) {
            $invalidProperties[] = "invalid value for 'zipCode', the character length must be smaller than or equal to 10.";
        }

        if ((mb_strlen($this->container['zipCode']) < 1)) {
            $invalidProperties[] = "invalid value for 'zipCode', the character length must be bigger than or equal to 1.";
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
     * Gets city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string $city The city from where the shipment is sent.
     *
     * @return self
     */
    public function setCity($city)
    {
        if ((mb_strlen($city) > 60)) {
            throw new \InvalidArgumentException('invalid length for $city when calling Address., must be smaller than or equal to 60.');
        }
        if ((mb_strlen($city) < 1)) {
            throw new \InvalidArgumentException('invalid length for $city when calling Address., must be bigger than or equal to 1.');
        }

        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->container['countryCode'];
    }

    /**
     * Sets countryCode
     *
     * @param string $countryCode The country code according to [iso-3166-1-alpha-3](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3) from where the shipment is sent.
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {

        if ((!preg_match("/^[A-Z]{3}$/", $countryCode))) {
            throw new \InvalidArgumentException("invalid value for $countryCode when calling Address., must conform to the pattern /^[A-Z]{3}$/.");
        }

        $this->container['countryCode'] = $countryCode;

        return $this;
    }

    /**
     * Gets zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->container['zipCode'];
    }

    /**
     * Sets zipCode
     *
     * @param string $zipCode The zip code from where the shipment is sent.
     *
     * @return self
     */
    public function setZipCode($zipCode)
    {
        if ((mb_strlen($zipCode) > 10)) {
            throw new \InvalidArgumentException('invalid length for $zipCode when calling Address., must be smaller than or equal to 10.');
        }
        if ((mb_strlen($zipCode) < 1)) {
            throw new \InvalidArgumentException('invalid length for $zipCode when calling Address., must be bigger than or equal to 1.');
        }

        $this->container['zipCode'] = $zipCode;

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


