<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LogoService
{
    private $client;
    private $apiKey;
    private $companyNames;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.api_ninjas.key');
        $this->companyNames = $this->getFamousCompanyNames();
        shuffle($this->companyNames);
    }

    public function getRandomLogo()
    {

        if (empty($this->companyNames)) {
            Log::warning("All company names have been used.");

            return null;
        }

        $companyName = array_pop($this->companyNames); // Get and remove the last element

        try {
            $response = $this->client->request('GET', 'https://api.api-ninjas.com/v1/logo', [
                'headers' => [
                    'X-Api-Key' => $this->apiKey,
                ],
                'query' => [
                    'name' => $companyName,  // You can change this to any keyword
                    'limit' => 1,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            Log::info("API Response Status: $statusCode");
            Log::info("API Response Body: $body");

            $logos = json_decode($body, true);

            if (! empty($logos)) {
                return [
                    'companyName' => $companyName,
                    'logo_url' => $logos[0]['image'],
                ];
            } else {
                Log::warning("No logos found for company: $companyName");
            }
        } catch (\Exception $e) {
            Log::error('Error fetching logo: ' . $e->getMessage());
        }

        return null;
    }

    private function getFamousCompanyNames()
    {
        return [
            "Apple",
            "Google",
            "Microsoft",
            "Amazon",
            "Facebook",
            "Coca-Cola",
            "Disney",
            "Nike",
            "McDonald's",
            "Toyota",
            "Samsung",
            "IBM",
            "Intel",
            "Honda",
            "BMW",
            "Mercedes-Benz",
            "Pepsi",
            "Adidas",
            "Starbucks",
            "Netflix",
            "Walmart",
            "Visa",
            "AT&T",
            "Verizon",
            "General Electric",
            "Ford",
            "Chevrolet",
            "Sony",
            "HP",
            "Dell",
            "Oracle",
            "SAP",
            "Cisco",
            "Adobe",
            "Salesforce",
            "Tesla",
            "SpaceX",
            "Twitter",
            "LinkedIn",
            "Instagram",
            "Uber",
            "Airbnb",
            "PayPal",
            "eBay",
            "Spotify",
            "Snapchat",
            "Pinterest",
            "Dropbox",
            "Slack",
            "Zoom",
            "Red Bull",
            "Nestlé",
            "Unilever",
            "Procter & Gamble",
            "Johnson & Johnson",
            "L'Oréal",
            "Ikea",
            "Zara",
            "H&M",
            "Lego",
            "Nintendo",
            "PlayStation",
            "Xbox",
            "Activision Blizzard",
            "Electronic Arts",
            "Nvidia",
            "AMD",
            "Qualcomm",
            "Texas Instruments",
            "TSMC",
            "Huawei",
            "Xiaomi",
            "Lenovo",
            "Asus",
            "Acer",
            "LG",
            "Panasonic",
            "Philips",
            "Siemens",
            "Bosch",
            "Volvo",
            "Audi",
            "Porsche",
            "Ferrari",
            "Lamborghini",
            "Rolex",
            "Cartier",
            "Gucci",
            "Louis Vuitton",
            "Chanel",
            "Nike",
            "Adidas",
            "Under Armour",
            "Puma",
            "Reebok",
            "Converse",
            "Vans",
            "New Balance",
            "Asics",
            "Fila",
        ];
    }
}
