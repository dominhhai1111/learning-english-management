<?php

return [
    define('LIMIT_PER_PAGE_PHOTOGRAPH',   2),
    define('LIMIT_PER_PAGE_INCOMPLETE_SENTENCES',   2),
    
    define('FLAG_ON',   1),
    define('FLAG_OFF',   0),
    
    define('PHOTOGRAPH',   1),
    define('QUESTION_RESPONSE',   2),
    define('SHORT_CONVERSATIONS',   3),
    define('SHORT_TALKS',   4),
    define('INCOMPLETE_SENTENCES',   5),
    define('TEXT_COMPLETION',   6),
    define('READING_COMPREHENSION',   7),
    
    define('EASY',   1),
    define('MEDIUM',   2),
    define('HARD',   3),
    
    "topic_types" => [
        PHOTOGRAPH              => 'Photograph',
        QUESTION_RESPONSE       => 'Question And Response',
        SHORT_CONVERSATIONS     => 'Short Conversations',
        SHORT_TALKS             => 'Short Talks',
        INCOMPLETE_SENTENCES    => 'Incomplete Sentences',
        TEXT_COMPLETION         => 'Text Completion',
        READING_COMPREHENSION   => 'Reading comprehension'
    ],
    
    "difficulty" => [
        EASY        => "Easy",
        MEDIUM      => "Medium",
        HARD        => "Hard"
    ],
];