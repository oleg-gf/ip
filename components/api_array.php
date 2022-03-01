<?php
    session_start();

    return [
        'ip-api.com'=>['first_string' => 'http://ip-api.com/json/',
                    'last_string' => '',
                    'country_code' => 'countryCode',
                        ],
        'ipwhois.app' => ['first_string' => 'http://ipwhois.app/json/',
                    'last_string' => '',
                    'country_code' => 'country_code',
                    
                    ],
        'seeip.org' => ['first_string' => 'https://ip.seeip.org/geoip/',
                    'last_string' => '',
                    'country_code' => 'country_code',
                    
                    ],
    ];

