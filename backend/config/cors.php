# backend/config/cors.php

'paths' => ['api/*', 'sanctum/csrf-cookie'],

# 將 'http://localhost:5173' 加入允許清單
'allowed_origins' => ['http://localhost:5173'], 

'allowed_origins_patterns' => [],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => false,