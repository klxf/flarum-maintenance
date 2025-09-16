<?php

namespace Klxf\MaintenanceMode\Middleware;

use Flarum\Http\SessionAccessToken;
use Flarum\Http\SessionAuthenticator;
use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MaintenanceAuthMiddleware implements RequestHandlerInterface
{
    protected $settings;
    protected $url;

    public function __construct(SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->settings = $settings;
        $this->url = $url;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $enable = $this->settings->get('klxf-maintenance.enabled', false);
        $auth = $this->settings->get('klxf-maintenance.auth', false);
        $token = SessionAccessToken::findValid(Arr::get($request->getQueryParams(), 'token'));
        $session = $request->getAttribute('session');

        if ($enable && $auth && !is_null($token))
        {
            (new SessionAuthenticator())->logIn($session, $token);
        }

        return new RedirectResponse($this->url->to('forum')->base());
    }
}