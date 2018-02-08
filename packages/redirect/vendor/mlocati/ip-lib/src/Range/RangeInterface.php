<?php 

namespace IPLib\Range;

use IPLib\Address\AddressInterface;

/**
 * Interface of all the range types.
 */
interface RangeInterface
{
    /**
     * Get the string representation of this address.
     *
     * @param bool $long Set to true to have a long/full representation, false otherwise.
     *
     * @return string
     *
     * @example If $long is true, you'll get '0000:0000:0000:0000:0000:0000:0000:0001/128', '::1/128' otherwise.
     */
    public function toString($long = false);

    /**
     * Get the short string representation of this address.
     *
     * @return string
     */
    public function __toString();

    /**
     * Get the type of the IP addresses contained in this range.
     *
     * @return int One of the \IPLib\Address\Type::T_... constants
     */
    public function getAddressType();

    /**
     * Check if this range contains an IP address.
     *
     * @param AddressInterface $address
     *
     * @return bool
     */
    public function contains(AddressInterface $address);

    /**
     * Get a string representation of the starting address of this range than can be used when comparing addresses and ranges.
     *
     * @return string
     */
    public function getComparableStartString();

    /**
     * Get a string representation of the final address of this range than can be used when comparing addresses and ranges.
     *
     * @return string
     */
    public function getComparableEndString();
}
