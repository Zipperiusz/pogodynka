<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\WeatherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country?}', name: 'app_weather')]
public function city(string $city, string $country = null, WeatherRepository $repository): Response
{
    $location = $repository->findLocationByCityAndCountry($city, $country);
    
    if (!$location) {
        throw $this->createNotFoundException('Location not found');
    }

    $weathers = $repository->findByLocation($location);

    return $this->render('weather/city.html.twig', [
        'location' => $location,
        'weathers' => $weathers,
    ]);
}

}