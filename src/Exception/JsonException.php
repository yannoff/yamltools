<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2021-06-19 19:23
 */

namespace Yannoff\YamlTools\Exception;

/**
 * Class JsonException
 *
 * @package Yannoff\YamlTools\Exception
 */
class JsonException extends EncoderException
{
    /**
     * Keep BC with older versions of PHP
     */
    const JSON_ERROR_INVALID_PROPERTY_NAME = 9;
    const JSON_ERROR_UTF16 = 10;

    /**
     * JsonException constructor.
     *
     * @param int $code One of the JSON_ERROR_* constants value
     */
    public function __construct($code = JSON_ERROR_NONE)
    {
        $message = $this->resolve($code);
        parent::__construct($message, $code);
    }

    /**
     * String representation of the exception
     * Display the error message suffixed with the error constant name
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s (%s)', $this->message,  $this->translate($this->code));
    }

    /**
     * Resolve the given JSON predefined error code to a human-readable message
     *
     * @param int $code One of the JSON_ERROR_* constants value
     *
     * @return string
     */
    protected function resolve($code)
    {
        switch ($code):
            case JSON_ERROR_DEPTH:
                return 'Max stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Invalid or malformed JSON';
            case JSON_ERROR_CTRL_CHAR:
                return 'Control character error, possibly incorrectly encoded';
            case JSON_ERROR_SYNTAX:
                return 'JSON contains syntax errors';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            case JSON_ERROR_RECURSION:
                return 'One or more recursive references in the value to be encoded';
            case JSON_ERROR_INF_OR_NAN:
                return 'One or more NAN or INF values in the value to be encoded';
            case JSON_ERROR_UNSUPPORTED_TYPE:
                return 'A value of a type that cannot be encoded was given';
            case self::JSON_ERROR_INVALID_PROPERTY_NAME:
                return 'A property name that cannot be encoded was given';
            case self::JSON_ERROR_UTF16:
                return 'Malformed UTF-16 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        endswitch;
    }

    /**
     * Resolve the given JSON predefined error code to the associated constant name
     * If the code doesn't match any constant, the numeric value is returned
     *
     * @param int $code One of the JSON_ERROR_* constants value
     *
     * @return string
     */
    protected function translate($code)
    {
        $errors = array_flip(
            array_filter(
                get_defined_constants(),
                function ($name){
                    return preg_match('/^JSON_ERROR/', $name);
                },
                ARRAY_FILTER_USE_KEY
            )
        );

        if (array_key_exists($code, $errors)) {
            return $errors[$code];
        }

        return (string) $code;
    }
}
