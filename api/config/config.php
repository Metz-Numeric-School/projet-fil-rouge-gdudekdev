<?php

namespace Config;

class Config
{

    public const TABLE_CONFIG = [
        'accounts' => 'Utilisateurs',
        'rides' => 'Trajets',
        'chats' => 'Conversations',
        'messages' => 'Messages',
        'bookings' => 'Réservations',
        'vehicules' => 'Véhicules',
        'companies' => 'Entreprises',
        'routes' => 'Itineraires',
        'ratings' => 'Notes',
        'preferences' => 'Préférences',
        'plannings' => 'Plannings',
        'car_brands' => 'Marques',
        'car_colors' => 'Couleurs',
        'car_models' => 'Modèles',
    ];
    public const TABLE_GROUP = [
        'users' => [
            'accounts',
            'companies',
            'plannings',
            'preferences'
        ],
        'rides' => [
            'rides',
            'bookings',
            'routes'
        ],
        'chats' => [
            'chats',
            'messages'
        ],
        'car' => [
            'vehicules',
            'car_brands',
            'car_colors',
            'car_models'
        ],
        'others' => [
            'ratings'
        ]
    ];
    public const TABLE_GROUP_NAME = [
        'users'=>'Utilisateurs',
        'rides'=>'Trajets',
        'chats'=>'Conversations',
        'car'=> 'Vehicules',
        'others'=>'Autres',
    ];
}
