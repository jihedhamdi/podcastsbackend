<?php

return [
    // The model which creates the comments aka the User model
    'models' => [
        'commenter' => \App\User::class,
        'comment' => \App\Model\user\Comment::class,
        'votes' => \tizis\laraComments\Entity\CommentVotes::class,
    ],
    'ui' => 'bootstrap4',
    'purifier' => [
        'HTML_Allowed' => 'p',
    ],
    'route' => [
        'root' => '',
        'group' => 'comments'
    ],
    'policy_prefix' => 'comments',
    'testing' => [
        'seeding' => [
            'commentable' => '\App\Post',
            'commenter' => '\App\User'
        ]
    ],
    /**
     * Only for API
     *
     * @example ['get']['preprocessor']['user'] => App\UseCases\CommentPreprocessor\User::class
     */
    'api' => [
        'get' => [
            'preprocessor' => [
                'comment' =>  App\Helpers\CommentPreprocessor\Comment::class,
                'user' =>  App\Helpers\CommentPreprocessor\User::class 
            ]
        ]
    ]
];