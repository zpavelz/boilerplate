<?php

namespace App\HealthCheck\Controller;

use App\HealthCheck\Service\HealthCheckService;
use FOS\RestBundle\Controller\{AbstractFOSRestController, Annotations as FOSRest};
use Symfony\Component\HttpFoundation\{JsonResponse, Request};

class HealthCheckController extends AbstractFOSRestController
{
    public function __construct(private HealthCheckService $service)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[FOSRest\Get("/api/health-check", methods: ['GET', 'OPTIONS'])]
    public function healthCheck(Request $request): JsonResponse
    {
        return new JsonResponse([]);
    }
}