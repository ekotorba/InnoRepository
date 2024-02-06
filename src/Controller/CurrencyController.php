<?php

namespace App\Controller;

use App\Client\NBPClient;
use App\Entity\Currency;
use App\Factory\CurrencyFactory;
use App\Repository\CurrencyRepository;
use App\Service\NBPCurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    public function __construct(
        protected NBPClient $NBPClient,
        protected NBPCurrencyService $currencyService,
        protected CurrencyRepository $currencyRepository,
        protected CurrencyFactory $currencyFactory,
    ) {
    }

    #[Route('/', name: 'app_get_currency' ,methods: 'GET')]
    public function index()
    {
        $foundCurrencies = $this->currencyRepository->findAll();

        $results = [];

        foreach ($foundCurrencies as $foundCurrency){
          $dto = $this->currencyFactory->buildFromModel($foundCurrency);
          $results[] = $dto;
        }

        return $this->json($results);
    }

    #[Route('/synchronize', name: 'app_synchronize', methods: 'POST')]
    public function synchronize()
    {
        $this->currencyService->synchronizeWithNBP();

        return $this->json(['Data has been successfully synchronized']);
    }
}
