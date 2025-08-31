<?php

return [
    'name' => 'Chat',
    
    /*
    |--------------------------------------------------------------------------
    | Chat Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for the chat module
    |
    */
    
    'max_message_length' => 1000,
    'messages_per_page' => 50,
    'auto_refresh_interval' => 5000, // milliseconds
    'file_upload_enabled' => true,
    'max_file_size' => 5120, // KB
    'allowed_file_types' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
];