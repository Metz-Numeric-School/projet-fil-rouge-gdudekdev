<!-- TODO faire un planning vide et faire en sorte qu'il soit utilisé lors de la création d'un compte -->
<!-- TODO voir pour les routes departure ... sur la structure de la bdd -->
<?php

// json_encode for usage
define(
    'DEFAULT_PLANNING',
    [
        "monday" => [
            "morning" => [
                "active" => true,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => true,
                "departureTime" => "17:00"
            ]
        ],
        "tuesday" => [
            "morning" => [
                "active" => true,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => true,
                "departureTime" => "17:00"
            ]
        ],
        "wednesday" => [
            "morning" => [
                "active" => true,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => true,
                "departureTime" => "17:00"
            ]
        ],
        "thursday" => [
            "morning" => [
                "active" => true,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => true,
                "departureTime" => "17:00"
            ]
        ],
        "friday" => [
            "morning" => [
                "active" => true,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => true,
                "departureTime" => "17:00"
            ]
        ],
        "saturday" => [
            "morning" => [
                "active" => false,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => false,
                "departureTime" => "17:00"
            ]
        ],
        "sunday" => [
            "morning" => [
                "active" => false,
                "departureTime" => "08:00"
            ],
            "evening" => [
                "active" => false,
                "departureTime" => "17:00"
            ]
        ]
    ]
);
