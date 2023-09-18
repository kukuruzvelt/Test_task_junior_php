<?php

namespace App\Controller;

use App\Service\CalculatePriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/companies', methods: ['GET'])]
    public function get_companies(): JsonResponse
    {
        $companies = [
            [
                'name' => 'PackGroup',
                'class' => 'App\Service\PackGroup',
            ],
            [
                'name' => 'TransCompany',
                'class' => 'App\Service\TransCompany',
            ],
        ];

        return new JsonResponse(['companies' => $companies,]);
    }

    #[Route('/calculate', methods: ['POST'])]
    public function calculate(Request $request, CalculatePriceService $calculatePriceService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $company_name = $data['company'];
        $weight = $data['weight'];

        $company = new $company_name();

        $price = $calculatePriceService->calculate($company, $weight);

        return new JsonResponse(['price' => $price]);
    }
}