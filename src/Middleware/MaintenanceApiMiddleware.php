<?php

namespace Klxf\MaintenanceMode\Middleware;

use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Tobscure\JsonApi\Document;

class MaintenanceApiMiddleware implements MiddlewareInterface
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->settings->get('klxf-maintenance.enabled', false)) {
            return $handler->handle($request);
        }

        if (RequestUtil::getActor($request)->hasPermission('klxf-maintenance.bypass')) {
            return $handler->handle($request);
        }

        return new JsonResponse(
            (new Document())->setErrors([
                'status' => '503',
                'title' => 'Under maintenance, please try again later.',
            ]),
            503,
            ['Content-Type' => 'application/vnd.api+json']
        );
    }
}