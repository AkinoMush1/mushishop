<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder as ESClientBuilder;
use Monolog\Logger;
use Psy\Util\Str;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 往服务容器中注入一个名为 alipay 的单例对象
        $this->app->singleton('alipay', function () {
            $config = config('pay.alipay');
//            $config['notify_url'] = route('payment.alipay.notify');
//            $config['return_url'] = route('payment.alipay.return');
            $config['notify_url'] = 'http://mush1.top/payment/alipay/notify';
            $config['return_url'] = 'http://mush1.top/payment/alipay/return';
            // 判断当前项目运行环境是否为线上环境
            if (app()->environment() !== 'production') {
                $config['mode'] = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\pay 来创建一个支付宝支付对象
            return Pay::alipay($config);
        });

        $this->app->singleton('wechat_pay', function () {
            $config = config('pay.wechat');
            if (app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\pay 来创建一个微信支付对象
            return Pay::wechat($config);
        });

        // Elasticsearch
        $this->app->singleton('es', function () {
            // 从配置文件读取 Elasticsearch 服务器列表
            $builder = ESClientBuilder::create()->setHosts(config('database.elasticsearch.hosts'));
            // 如果是开发环境
            if (app()->environment() === 'local') {
                // 配置日志，Elasticsearch 的请求和返回数据将打印到日志文件中，方便我们调试
                $builder->setLogger(app('log')->driver());
            }

            return $builder->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['products.index', 'products.show'], \App\Http\ViewComposers\CategoryTreeComposer::class);

        if (app()->environment('local')) {
            DB::listen(function ($query) {
                Log::info(\Illuminate\Support\Str::replaceArray('?', $query->bindings, $query->sql));
            });
        }
    }
}
