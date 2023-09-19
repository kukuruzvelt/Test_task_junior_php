<?php

namespace App\Controller;

use App\Service\CalculatePriceService;
use mysql_xdevapi\Exception;
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
        try {
            $data = json_decode($request->getContent(), true);

            $company_name = $data['company'];
            $weight = $data['weight'];

            $company = new $company_name();

            $price = $calculatePriceService->calculate($company, $weight);
        }
        catch (\Exception $exception){
            new JsonResponse(data: 'Something went wrong', status: 500);
        }

        return new JsonResponse(['price' => $price]);
    }
}