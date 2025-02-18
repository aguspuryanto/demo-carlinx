<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Inspector extends BaseConfig
{
    /**
     * Enable/disable the Inspector monitoring.
     *
     * @var bool
     */
    public $enabled = false;

    /**
     * Your Ingestion Key.
     *
     * @var string
     */
    public $ingestionKey = '';

    /**
     * Transport options.
     *
     * @var array
     */
    public $transport = [
        'type' => 'async',
        'options' => [],
    ];

    /**
     * Max items to record in a single session.
     *
     * @var int
     */
    public $maxItems = 100;

    public function __construct()
    {
        parent::__construct();
        
        // Load ingestion key from environment
        $this->ingestionKey = env('INSPECTOR_INGESTION_KEY') ?? '';
    }
}
