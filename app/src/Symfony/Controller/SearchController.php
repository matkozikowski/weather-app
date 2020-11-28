<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Symfony\Form\SearchType;
use App\Model\DTO\SearchDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
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
            ]
        );
    }

    /**
     * @Route("/search",  name="search", methods={"POST"})
     */
    public function search(Request $request): Response
    {
        $data = $request->request->get('search');
        dump($data);
        die();
    }

    private function createSearchForm(): FormInterface
    {
        return $this->createForm(
            SearchType::class,
            null,
            [
                'action' => $this->generateUrl('search'),
                'method' => Request::METHOD_POST,
            ]
        );
    }

}
