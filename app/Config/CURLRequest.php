<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CURLRequest extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * CURLRequest Share Options
     * --------------------------------------------------------------------------
     *
     * Whether share options between requests or not.
     *
     * If true, all the options won't be reset between requests.
     * It may cause an error request with unnecessary headers.
     */
    public bool $shareOptions = true;

    /**
     * --------------------------------------------------------------------------
     * CURLRequest Timeout
     * --------------------------------------------------------------------------
     *
     * The number of seconds to wait while trying to connect.
     */
    public int $timeout = 5;

    /**
     * --------------------------------------------------------------------------
     * CURLRequest Connect Timeout
     * --------------------------------------------------------------------------
     *
     * The number of seconds to wait while trying to connect.
     */
    public int $connectTimeout = 3;

    /**
     * --------------------------------------------------------------------------
     * CURLRequest SSL Verify
     * --------------------------------------------------------------------------
     *
     * Whether to verify SSL certificates.
     */
    public bool $sslVerify = false;
}
