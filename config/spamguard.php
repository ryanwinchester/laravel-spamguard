<?php

return [

    /**
     * The error messages to use with failed middleware validation.
     */
    'messages' => [
        'spam_honeypot' => 'I guess the honey was just too sweet for you.',
        'spam_timer'    => 'Please, not too fast or not too slow. There is a happy medium.',
    ],

    /**
     * The default times used by the spam_timer middleware validation.
     */
    'min_time' => 5,
    'max_time' => 3600,

];
