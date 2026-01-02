<?php

return [
    /*
     * Table name settings for caching provinces, cities, and districts
     */
    'table_prefix' => 'cekongkir_',

    /*
     * Set the connection timeout for the requests
     */
    'timeout' => env('RAJAONGKIR_TIMEOUT', 30),

    'save_new_data' => true,
];