<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 12/12/2019
 * Time: 2:22 PM
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request as LaravelRequest;
use Closure;
use Illuminate\Support\Facades\Cache;

class RouteCacheMiddleware
{
    /**
     * @var bool|mixed
     */
    private $allowCache = false;

    /**
     * @var float|int
     */
    private $ttl = 60*24;

    /**
     * @var array
     */
    private $routes = [
        '*'
    ];

    /**
     * RouteCacheMiddleware constructor.
     */
    public function __construct()
    {
        $this->allowCache = env('APP_CACHE', false);
    }

    /**
     * @param LaravelRequest $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(LaravelRequest $request, Closure $next)
    {
        //Check this route should cache
        //Cache::flush();
        $ajaxRequest = $request->ajax();
        $cacheRow = $this->shouldBeCached($request, $this->routes);

        if (!$cacheRow || $ajaxRequest || !$this->allowCache || $request->is('refresh-template*') || $request->is('admin/*')) {
            return $next($request);
        }

        $cacheKey = $this->getCacheKey($request->fullUrl());
        if (!Cache::has($cacheKey)) {
            $response = $next($request);
            $content = $response->getContent() . '<!-- Cache generated in: '.date('Y-m-d H:i:s').' -->';

            // Cache home page
            if ($request->is('/')) {
                @file_put_contents(public_path('index.html'), $content . '<!-- Return from index.html -->');
            }

            Cache::put($cacheKey, $content, $this->ttl);
        }

        return \Response::make($this->getCachedContent($cacheKey, $request, Cache::get($cacheKey)), 200);
    }

    /**
     * add instrumentation to help with debug. Adding ?debug
     * to a cached url will precede the content with "CACHED"
     *
     * @param $cacheKey
     * @param $request
     * @param $content
     * @return string
     */
    protected function getCachedContent($cacheKey, $request, $content)
    {
        $isDebugRequest = $request->exists('debug') || $request->exists('cache-info');
        if ($isDebugRequest) {
            return $content.'
            <div class="cache-notice" style="display: block; position: fixed; width: 50%; background: #fff; padding: 20px 30px 25px; left: 50%; border: 1px solid #aaa; margin-left: calc(-50% / 2); bottom: 10%; z-index: 500; box-shadow: 0 0 20px rgba(0,0,0,0.2); font-size: 16px; font-size: 1.6rem;">
                <div class="title" style="margin: -20px -30px 10px; background: #999; color: #fff; padding: 10px 30px; text-align: center;">CACHED CONTENT</div>
                <span class="cache_key" style="display: inline-block; width: 100%; background: #fff; padding: 10px 10px 10px 0; margin-bottom: -10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span class="title" style="float: left; width:45px; color: #000; font-weight: bold; line-height: 30px;">URL: </span>
                    <input readonly class="value" style="float: left; width: calc(100% - 45px); border:1px solid #000; color: red; padding: 5px 7px; height: 30px; background: #eee" type="text" value="'.$request->url().'">
                </span>
                <span class="cache_key" style="display: inline-block; width: 100%; background: #fff; color: red; padding: 10px 10px 10px 0; margin-bottom: -10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span class="title" style="float: left; width:45px; color: #000; font-weight: bold; line-height: 30px;">KEY: </span>
                    <input readonly class="value" style="float: left; width: calc(100% - 45px); border:1px solid #000; color: red; padding: 5px 7px; height: 30px; background: #eee" type="text" value="'.$cacheKey.'">
                </span>
                <hr style="border:none;">
                <a href="'.$request->url().'" class="cancel" style="float: left; background: #aaa; color: #fff; padding: 10px 15px; margin-top: 20px; text-decoration: none;">Cancel</a>
                <a href="?cache-clear" class="alert alert-info" style="float: right; background: #1991d1; color: #fff; padding: 10px 15px; margin-top: 20px; text-decoration: none;">Clear this now</a>
            </div>';
        }

        if ($request->exists('cache-clear')) {
            Cache::forget($cacheKey);
            return \Redirect::to($request->url());
        }

        return $content;
    }

    //generate a cache key based on the url

    /**
     * @param $url
     * @return string
     */
    protected function getCacheKey($url)
    {
        return 'data.' . md5($url);
    }

    /**
     * @param $request
     * @return bool
     */
    protected function shouldBeCached($request, $cacheRouteRows)
    {
        foreach ($cacheRouteRows as $cacheRow) {
            if ($request->is($cacheRow)) {
                return $cacheRow;
            }
        }

        return false;
    }
}