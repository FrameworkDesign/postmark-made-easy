<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Path configuration
    |--------------------------------------------------------------------------
    |
    | Change the paths, so they fit your needs
    |
     */
    'pathToEnv'       => base_path('.env'),
    'backupPath'      => base_path('content/postmark-made-easy/'),
    'filePermissions' => env('FILE_PERMISSIONS', 0755),

    'settings-blueprint' => [
        'name' => [
            'display' => 'General',
            'fields' => [
                'postmark_made_easy_intro' => [
                    'type' => 'section',
                    'display' => 'Postmark Made Easy settings',
                    'instructions' => 'Like do you want it turned on or off, complex settings like that'
                ],
                'postmark_made_easy_mail_driver' => [
                    'type' => 'select',
                    'display' => 'Mail driver',
                    'instructions' => 'Mail driver (Laravel developers know this as MAIL_DRIVER). if you want to use postmark, change it to postmark',
                    'validate' => 'required|string',
                    'options' => [
                        "smtp" => "smtp",
                        "sendmail" => "sendmail",
                        "mailgun" => "mailgun",
                        "ses" => "ses",
                        "postmark" => "postmark",
                        "log" => "log",
                        "array" => "array"
                    ]
                ],
                'postmark_made_easy_api_key' => [
                    'type' => 'text',
                    'character_limit' => '500',
                    'display' => 'Postmark API Key',
                    'instructions' => 'Instructions to get API key <a class="text-blue-300" href="https://docs.gravityforms.com/get-postmark-api-keys/" target="_blank">here</a>',
                    'validate' => 'required|string',
                ],
                'postmark_made_easy_email' => [
                    'type' => 'text',
                    'character_limit' => '500',
                    'display' => 'Test email, where do you want to send a test to?',
                    'instructions' => 'The URL of the API route',
                    'validate' => 'required|string|email',
                ],
            ],
        ]
    ]
];
