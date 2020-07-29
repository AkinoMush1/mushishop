<?php

return [
    'alipay' => [
        'app_id' => '2021000116697199',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhgYhWhsLMGu9OJTJz8SbLj9rU/Y+HxvL5gw/a7Edc+8Y0TR7Bh1xI2ivffoIFr8VnT+3+TbXoa3DnoMxqxH4AKvKlHCNo0z3JJcjJwDMIb/qSms7r2hd0ECYH3K8gospR1NZGHLt4EwomV4Oq3ubkSOFmpSpO0TPMNnQoOAzwEZMuJc6iYggDirBgQL63wdlvrBv+3aAeN8b5k4QfAWWpOa867cH922rJqrFIUXJwKioUU1P56LFM7ZK1Z/pSxn3TXtPe+YpAx+XjMJFPjbyRRuyi3pt2ctIt3oxBH+9XfZ4mSBaVPsnriCXgdVho6afPfaASNwfAq5vlAwdny6dYwIDAQAB',
        'private_key' => 'MIIEogIBAAKCAQEAgkvRIy8oRwwZwZvESr/e5KEnbNZK8nu4OJFnUcesLqgFN2I+R5RO+ns8/GL7/oKU0kDYQIxTRzFkgmDf2rmcYhfmH65r1XeE8gURoCQXEGm0vKu1V1/TlJXlqJ2CmoQXsfdaQerXrkCGFm+46jbSBHztAkRWAemj8xuOTOD5bpbrWd/yNgHmLDMPu0gFoRM+VpVvPU4j4D6dUY4gEuoPZTnT60QQvRPPBw9hM5tDx1FFLgRMJntH62A481/zay4qdPJS6AOywqK8aqIVNLnWq15qTUsNUn29mLsoy8AVJf3AEWGsy9caZzrcj0t+sUHN4TZpSl4yh4iS7XH4Co0TewIDAQABAoIBAFK9dIxEOO6M95ojoU3ac995msCZgDRlbkG1zAd5pZRnLBDUeToZKuIS+lJHRUCEiZ7OgMTUl1mhOvM0M1MBBRahmIfLyjxfTnQl1eB8qozIo3YgD+LxPjmfypv9kd8vPKDNs2oiiF3mKX/76FALCejBr/v9iyRhyrPpbr7RKnQXvtOTTK0tSpissG1Ww+pNNQbmkSbWglnrNcDOPdNvGiqEKEXd3qSPTKv6R5r4mcWFXXlGWd1lJQVEeN2u0dRFUS+yAtLQywBAKfXV59lHKbT9hegsajpgAC3vMVFqTIFAHdUFsY+XqCniNRZO9aL3JprxE1CcFhrIxrNRy61nsUkCgYEA8w9qNfLEIbFStCAZ9/B2QDoYUR15tGtOUMiRCVahWr+OH8Vg+rbSFAaxI6o7J5YjbofDkiErQbmcfqEbF2YlEYENUaWkIlKPIBCG2RtezZM54KfRzv+ZhPLWHXcxJJEopsLKBegMPlQc6ly6An/zj+Pl4nH3kth8KICIlq7x2CcCgYEAiTuUPQHSclRDQiIh/swPS27QhGGwJcLdz2FIJLtUu+VRCl7+wft3ubbPkBLbP8O3GwFXxMfvPiNiyDEQ5vM1RHLef/DdRiK11ReE35/7zPn067zF2xd/vGET1GnjK6MOfxYKOqx/K0UOr0+YnWdzcrMgE8fKMOSXJl9md7kMio0CgYBZGkiMWF+wHko8QBxk+SDQcLujWNPZ4RCHqs8IhlqGYvyeBwSDRGwE7WMYuPoQjAiXJ2v5cPFjmcCV50eAL3DdVtrkGH3wGyXe0lAs3MzHPfaUtdDDOo4z37XAfYZlalVltLjMq4F5g+pJvA5whilqkVgfyDnC+luhmWT5IE8GNwKBgH0KHj2gJWIqyMW/V/5TbDQtGi0k3VzquzQzzYo6bjBt93Ndrv6M5EABBAqgQ8lLyNEAXjpcee7CS0Vg/6ePPp/JklY830ECa29n6Jfhq4rOzYzmCdlhBfBc+7Z1bJncDl9Zc6SWe6CvYXv3KHVzR0vhTn73cZEvF1HNZw37PCQZAoGADmiuGwhkBik+YP2heOJW2lt1ALZTux+5yzHdYbONWsZtGTg1qFymygOw3buWnUqEmUFMA4OsbwhMsU9/nBRICWDNLXNvx+AZpMREBCPc/q4sph4qOfAYKcaTMH4nHlA7MYrkmlZc+J7Yo9ArveBzde4bhkKnKANH+ZWEj1k2P44=',
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id' => '',
        'mch_id' => '',
        'key' => '',
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
