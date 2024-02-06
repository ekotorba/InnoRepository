<?php

namespace App\Service;

use App\Client\NBPClient;
use App\DTO\CurrencyDTO;
use App\Entity\Currency;
use App\Factory\CurrencyFactory;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

class NBPCurrencyService
{
    public NBPClient $NBPClient;
    private CurrencyFactory $currencyFactory;
    private CurrencyRepository $currencyRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CurrencyFactory $currencyFactory, CurrencyRepository $currencyRepository, EntityManagerInterface $entityManager, NBPClient $NBPClient)
    {
        $this->currencyFactory = $currencyFactory;
        $this->currencyRepository = $currencyRepository;
        $this->entityManager = $entityManager;
        $this->NBPClient = $NBPClient;
    }

    public function synchronizeWithNBP(): void
    {
        $currencies = $this->fetchNBPCurrencies();

        foreach ($currencies as $currencyDTO) {
         $currency  = $this->createOrUpdateCurrency($currencyDTO);

            $this->entityManager->persist($currency);
        }

        $this->entityManager->flush();
    }

    public function fetchNBPCurrencies(): array
    {
        $payload = $this->NBPClient->fetchNBPApi();

        if (empty($payload)) {
            throw new RuntimeException('No currencies returned from NBP');
        }

        $result = [];

        foreach ($payload as $currencyDTO) {
            $result[] = $this->currencyFactory::build($currencyDTO);
        }

        return $result;
    }

    public function createOrUpdateCurrency(CurrencyDTO $currencyDTO): Currency
    {
        $foundCurrency = $this->currencyRepository->findOneBy(['currencyCode' => $currencyDTO->currencyCode]);

        return empty($foundCurrency) ? $this->createCurrency($currencyDTO) : $foundCurrency->setExchangeRate($currencyDTO->exchangeRate);
    }

    public function createCurrency(CurrencyDTO $currencyDTO): Currency
    {
        $currency = new Currency();
        $currency->setCurrencyName($currencyDTO->currencyName);
        $currency->setCurrencyCode($currencyDTO->currencyCode);
        $currency->setExchangeRate($currencyDTO->exchangeRate);
        return $currency;
    }
}
