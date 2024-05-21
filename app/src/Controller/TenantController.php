<?php

namespace App\Controller;

use App\Repository\RentalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/tenant')]
#[isGranted('ROLE_TENANT')]
class TenantController extends AbstractController
{
    private RentalRepository $rentalRepository;
    private SerializerInterface $serializer;

    public function __construct(RentalRepository $rentalRepository, SerializerInterface $serializer)
    {
        $this->rentalRepository = $rentalRepository;
        $this->serializer = $serializer;
    }

    #[Route('/', name: 'app_home_tenant')]
    public function index(): Response
    {
        $localisations = $this->rentalRepository->findAllLocalities();
        foreach ($localisations as $localisation) {
            $localities[] = $localisation['localisation'];
        }

        return $this->render('tenant/index.html.twig', [
            'rentals' => $this->rentalRepository->findAll(),
            'localities' => $localities,
        ]);
    }

    #[Route('/rental/{id}', name: 'app_rental_tenant')]
    public function rental(int $id): Response
    {
        return $this->render('tenant/viewDetails.html.twig', [
            'rental' => $this->rentalRepository->find($id),
        ]);
    }

    #[Route('/search', name: 'app_search_rental_for_tenant', methods: ['POST', 'GET'])]
    public function search(Request $request): JsonResponse
    {
        $data = $this->rentalRepository->findBy(['localisation' => $request->get('locality')]);
        dump($data);
        return new JsonResponse(
            $this->serializer->serialize($data, 'json', ['groups' => 'rental']),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
