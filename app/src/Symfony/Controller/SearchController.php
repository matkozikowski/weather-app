<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Symfony\Form\SearchType;
use App\CQRS\SystemInterface;
use App\Application\Command\SearchWeather;
use App\Application\Query\WeatherQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SearchController extends AbstractController
{
    /**
     * @var SystemInterface
     */
    private $system;

    public function __construct(SystemInterface $system)
    {
        $this->system = $system;
    }

    /**
     * @Route("/",  name="home", methods={"GET"})
     */
    public function index(): Response
    {
        $searchForm = $this->createSearchForm();

        return $this->render(
            'home/index.html.twig',
            [
                'form' => $searchForm->createView(),
                'weather_list' => $this->system->query(WeatherQuery::class)->findAll(),
            ]
        );
    }

    /**
     * @Route("/search",  name="search", methods={"POST"})
     */
    public function search(Request $request): RedirectResponse
    {
        $data = $request->request->get('search');

        $form = $this->createSearchForm($data);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchWeather = new SearchWeather(
                $data['country'],
                $data['city']
            );

            $this->system->handle($searchWeather);
        }

        return $this->redirectToRoute('home');
    }

    private function createSearchForm(array $data = []): FormInterface
    {
        return $this->createForm(
            SearchType::class,
            $data,
            [
                'action' => $this->generateUrl('search'),
                'method' => Request::METHOD_POST,
            ]
        );
    }

}
