<?php
declare(strict_types=1);

namespace Utilities\Common;

/**
 * Validator class
 *
 * @link    https://github.com/utilities-php/common
 * @author  Shahrad Elahi (https://github.com/shahradelahi)
 * @license https://github.com/utilities-php/common/blob/master/LICENSE (MIT License)
 */
class Validator
{

    /**
     * Validate a uuid
     *
     * @param string $uuid
     * @return bool
     */
    public static function isUuid(string $uuid): bool
    {
        return preg_match('/^{?[0-9a-f]{8}-?[0-9a-f]{4}-?[0-9a-f]{4}-?' . '[0-9a-f]{4}-?[0-9a-f]{12}}?$/i', $uuid) === 1;
    }

    /**
     * Email Validation
     *
     * @param string $email
     * @return bool
     */
    public static function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Json Validation
     *
     * @param $string
     * @return bool
     */
    public static function isJson($string): bool
    {
        return is_string($string) && is_array(json_decode($string, true));
    }

    /**
     * Check string is a url encoded string or not
     *
     * @param mixed $string
     * @return bool
     */
    public static function isUrlEncode(mixed $string): bool
    {
        if (!is_string($string)) return false;
        return preg_match('/%[0-9A-F]{2}/i', $string);
    }

    /**
     * Phone Number Validation
     *
     * @param string $phone
     * @return bool
     */
    public static function isPhone(string $phone): bool
    {
        return preg_match('/^[0-9]{10}$/', $phone);
    }

    /**
     * Validate the given string|int is a valid timestamp
     *
     * @param string|int $timestamp
     * @return bool
     */
    public static function isTimestamp(string|int $timestamp): bool
    {
        return (bool)strtotime($timestamp);
    }

    /**
     * Validate the given string is an url
     *
     * @param ?string $url
     * @return bool
     */
    public static function isUrl(?string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Check if array is associative
     *
     * @param array $array
     * @return bool
     */
    public static function isAssoc(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Check is the given string is a valid user-agent
     *
     * @param string $userAgent
     * @return bool
     */
    public static function isUserAgent(string $userAgent): bool
    {
        return preg_match('/^(Mozilla|Opera|Chrome|Safari|Firefox|MSIE|Trident|Edge)\/[0-9.]+/', $userAgent);
    }

    /**
     * Check if the given string is a valid IP address
     *
     * @param string $ip
     * @return bool
     */
    public static function isIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    /**
     * Check if the given string is a valid IPv4 address
     *
     * @param string $ip
     * @return bool
     */
    public static function isIpv4(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Check if the given string is a valid IPv6 address
     *
     * @param string $ip
     * @return bool
     */
    public static function isIpv6(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * isString
     *
     * @param mixed $string
     * @param int $min_length
     * @param int $max_length
     * @return bool
     */
    public static function isString(mixed $string, int $min_length = 0, int $max_length = 0): bool
    {
        if (!is_string($string)) return false;
        if ($min_length > 0 && strlen($string) < $min_length) return false;
        if ($max_length > 0 && strlen($string) > $max_length) return false;
        return true;
    }

    /**
     * Data Type Validation
     *
     * Types: string, int, float, bool, array, object, null, ...
     *
     * @param array $data e.g. ['name' => 'string', 'age' => 'int', 'is_admin' => 'bool']
     * @return bool
     */
    public static function dataType(array $data): bool
    {
        foreach ($data as $key => $type) {
            if (gettype($key) != $type) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate with a callback function
     *
     * @param array $values
     * @param callable $callback
     * @return bool
     */
    public static function withCallback(array $values, callable $callback): bool
    {
        foreach ($values as $value) {
            if (!$callback($value)) {
                return false;
            }
        }

        return true;
    }

}