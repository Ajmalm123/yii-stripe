<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'stripe' => [
            'class' => 'app\components\StripeComponent',
            // 'stripe_key' => 'pk_test_51P3KOU08wKd0e4UeyKhlcFMGqRGBRKUgrljBFY8njq1NTZVq9HY0voI1j9iKDW3Nh33Auhq2Wz1AzUSQYFvZ04rJ00ItJlZoLS',
            'secretKey' => 'sk_test_51P3KOU08wKd0e4UeUp4KxHVDcDdQTwiFf6znXDxebNnSZlGKXVYPM8Wx24E8bYWm5wYh8RRYRk9MdO4rNSKrRNtA00UlHkbgSK'
        ],  
    ],
];
