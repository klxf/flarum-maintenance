<?php

namespace Klxf\MaintenanceMode\Middleware;

use Flarum\Foundation\Paths;
use Flarum\Http\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Str;
use Klxf\MaintenanceMode\Util\BladeCompiler;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MaintenanceForumMiddleware implements MiddlewareInterface
{
    protected $settings;
    protected $view;
    protected $assets_dir;
    protected $url;

    public function __construct(SettingsRepositoryInterface $settings, Factory $view, Paths $paths, UrlGenerator $url)
    {
        $this->settings = $settings;
        $this->view = $view;
        $this->assets_dir = $paths->public.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
        $this->url = $url;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->settings->get('klxf-maintenance.enabled', false)) {
            return $handler->handle($request);
        }

        if (RequestUtil::getActor($request)->hasPermission('klxf-maintenance.bypass')) {
            return $handler->handle($request);
        }

        if (Str::startsWith($request->getUri()->getPath(), '/maintenance/auth/')) {
            return $handler->handle($request);
        }

        $cssFile = preg_grep('~^forum.*\.css$~', scandir($this->assets_dir));

        $template = $this->settings->get(
            'klxf-maintenance.template',
            file_get_contents(__DIR__."/../../resources/defaults/template.blade.php")
        );

        $view = BladeCompiler::render($template, [
            'settings'   => $this->settings,
            'url'        => $this->url,
            'forumStyle' => !empty($cssFile) ? file_get_contents($this->assets_dir.reset($cssFile)) : ""
        ]);

        return new HtmlResponse($view, 503);
    }
}