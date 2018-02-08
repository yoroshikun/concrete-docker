<?php 

namespace IPLib\Address;

use IPLib\Range\Subnet;
use IPLib\Range\RangeInterface;
use IPLib\Range\Type as RangeType;

/**
 * An IPv6 address.
 */
class IPv6 implements AddressInterface
{
    /**
     * The long string representation of the address.
     *
     * @var string
     *
     * @example '0000:0000:0000:0000:0000:0000:0000:0001'
     */
    protected $longAddress;

    /**
     * The long string representation of the address.
     *
     * @var string|null
     *
     * @example '::1'
     */
    protected $shortAddress;

    /**
     * The byte list of the IP address.
     *
     * @var array|null
     */
    protected $bytes;

    /**
     * The word list of the IP address.
     *
     * @var array|null
     */
    protected $words;

    /**
     * The type of the range of this IP address.
     *
     * @var int|null
     */
    protected $rangeType;

    /**
     * Initializes the instance.
     *
     * @param string $longAddress
     */
    public function __construct($longAddress)
    {
        $this->longAddress = $longAddress;
        $this->shortAddress = null;
        $this->bytes = null;
        $this->words = null;
        $this->rangeType = null;
    }

    /**
     * Parse a string and returns an IPv6 instance if the string is valid, or null otherwise.
     *
     * @param string|mixed $address
     *
     * @return static|null
     */
    public static function fromString($address)
    {
        $result = null;
        if (is_string($address) && strpos($address, ':') !== false && strpos($address, ':::') === false) {
            if (strpos($address, '::') === false) {
                $chunks = explode(':', $address);
            } else {
                $chunks = array();
                $parts = explode('::', $address);
                if (count($parts) === 2) {
                    $before = ($parts[0] === '') ? array() : explode(':', $parts[0]);
                    $after = ($parts[1] === '') ? array() : explode(':', $parts[1]);
                    $missing = 8 - count($before) - count($after);
                    if ($missing >= 0) {
                        $chunks = $before;
                        if ($missing !== 0) {
                            $chunks = array_merge($chunks, array_fill(0, $missing, '0'));
                        }
                        $chunks = array_merge($chunks, $after);
                    }
                }
            }
            if (count($chunks) === 8) {
                $nums = array_map(
                    function ($chunk) {
                        return preg_match('/^[0-9A-Fa-f]{1,4}$/', $chunk) ? hexdec($chunk) : false;
                    },
                    $chunks
                );
                if (!in_array(false, $nums, true)) {
                    $longAddress = implode(
                        ':',
                        array_map(
                            function ($num) {
                                return sprintf('%04x', $num);
                            },
                            $nums
                        )
                    );
                    $result = new static($longAddress);
                }
            }
        }

        return $result;
    }

    /**
     * Parse an array of bytes and returns an IPv6 instance if the array is valid, or null otherwise.
     *
     * @param int[]|array $bytes
     *
     * @return static|null
     */
    public static function fromBytes(array $bytes)
    {
        $result = null;
        if (count($bytes) === 16) {
            $address = '';
            for ($i = 0; $i < 16; ++$i) {
                if ($i !== 0 && $i % 2 === 0) {
                    $address .= ':';
                }
                $byte = $bytes[$i];
                if (is_int($byte) && $byte >= 0 && $byte <= 255) {
                    $address .= sprintf('%02x', $byte);
                } else {
                    $address = null;
                    break;
                }
            }
            if ($address !== null) {
                $result = new static($address);
            }
        }

        return $result;
    }

    /**
     * Parse an array of words and returns an IPv6 instance if the array is valid, or null otherwise.
     *
     * @param int[]|array $words
     *
     * @return static|null
     */
    public static function fromWords(array $words)
    {
        $result = null;
        if (count($words) === 8) {
            $chunks = array();
            for ($i = 0; $i < 8; ++$i) {
                $word = $words[$i];
                if (is_int($word) && $word >= 0 && $word <= 0xffff) {
                    $chunks[] = sprintf('%04x', $word);
                } else {
                    $chunks = null;
                    break;
                }
            }
            if ($chunks !== null) {
                $result = new static(implode(':', $chunks));
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::toString()
     */
    public function toString($long = false)
    {
        if ($long) {
            $result = $this->longAddress;
        } else {
            if ($this->shortAddress === null) {
                $chunks = array_map(
                    function ($word) {
                        return dechex($word);
                    },
                    $this->getWords()
                );
                $shortAddress = implode(':', $chunks);
                for ($i = 8; $i > 1; --$i) {
                    $search = '(?:^|:)'.rtrim(str_repeat('0:', $i), ':').'(?:$|:)';
                    if (preg_match('/^(.*?)'.$search.'(.*)$/', $shortAddress, $matches)) {
                        $shortAddress = $matches[1].'::'.$matches[2];
                        break;
                    }
                }
                $this->shortAddress = $shortAddress;
            }
            $result = $this->shortAddress;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::__toString()
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::getBytes()
     */
    public function getBytes()
    {
        if ($this->bytes === null) {
            $bytes = array();
            foreach ($this->getWords() as $word) {
                $bytes[] = $word >> 8;
                $bytes[] = $word & 0xff;
            }
            $this->bytes = $bytes;
        }

        return $this->bytes;
    }

    /**
     * Get the word list of the IP address.
     *
     * @return int[]
     */
    public function getWords()
    {
        if ($this->words === null) {
            $this->words = array_map(
                function ($chunk) {
                    return hexdec($chunk);
                },
                explode(':', $this->longAddress)
            );
        }

        return $this->words;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::getAddressType()
     */
    public function getAddressType()
    {
        return Type::T_IPv4;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::getRangeType()
     */
    public function getRangeType()
    {
        if ($this->rangeType === null) {
            switch (true) {
                // ::/128 - rfc4291
                case $this->longAddress === '0000:0000:0000:0000:0000:0000:0000:0000':
                    $this->rangeType = RangeType::T_UNSPECIFIED;
                    break;
                // ::1/128 - rfc4291
                case $this->longAddress === '0000:0000:0000:0000:0000:0000:0000:0001':
                    $this->rangeType = RangeType::T_LOOPBACK;
                    break;
                // 100::/64 - rfc4291
                case strpos($this->longAddress, '0100:0000:0000:0000') === 0:
                    $this->rangeType = RangeType::T_DISCARDONLY;
                    break;
                // 100::/8 - rfc4291
                case strpos($this->longAddress, '01') === 0:
                    $this->rangeType = RangeType::T_DISCARD;
                    break;
                // 2002::/16 - rfc4291
                case strpos($this->longAddress, '2002') === 0:
                    $this->rangeType = $this->toIPv4()->getRangeType();
                    break;
                // 2000::/3 - rfc4291
                case $this->matches(Subnet::fromString('2000::/3')):
                    $this->rangeType = RangeType::T_PUBLIC; // Unicast global addresses
                    break;
                // fc00::/7 - rfc4193
                case $this->matches(Subnet::fromString('fc00::/7')):
                    $this->rangeType = RangeType::T_PRIVATENETWORK;
                    break;
                // fe80::/10 - rfc4291
                case $this->matches(Subnet::fromString('fe80::/10')):
                    $this->rangeType = RangeType::T_LINKLOCAL_UNICAST;
                    break;
                // ff00::/8 - rfc4291
                case strpos($this->longAddress, 'ff') === 0:
                    $this->rangeType = RangeType::T_MULTICAST;
                    break;
                // ::/8 - rfc4291
                // 200::/7 - rfc4048
                // 400::/6 - rfc4291
                // 800::/5 - rfc4291
                // 1000::/4 - rfc4291
                // 4000::/3 - rfc4291
                // 6000::/3 - rfc4291
                // 8000::/3 - rfc4291
                // a000::/3 - rfc4291
                // c000::/3 - rfc4291
                // e000::/4 - rfc4291
                // f000::/5 - rfc4291
                // f800::/6 - rfc4291
                // fe00::/9 - rfc4291
                // fec0::/10 - rfc3879
                default:
                    $this->rangeType = RangeType::T_RESERVED;
                    break;
            }
        }

        return $this->rangeType;
    }

    /**
     * Create an IPv4 representation of this address (if possible, otherwise returns null).
     *
     * @return IPv4|null
     */
    public function toIPv4()
    {
        $result = null;
        if (strpos($this->longAddress, '2002:') === 0) {
            $result = IPv4::fromBytes(array_slice($this->getBytes(), 2, 4));
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::getComparableString()
     */
    public function getComparableString()
    {
        return $this->longAddress;
    }

    /**
     * {@inheritdoc}
     *
     * @see AddressInterface::matches()
     */
    public function matches(RangeInterface $range)
    {
        return $range->contains($this);
    }
}
