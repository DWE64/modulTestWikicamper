<?php

namespace App\Controller;

use App\Message\MailContact;
use App\Repository\RentalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    private MessageBusInterface $bus;
    private RentalRepository $rentalRepository;

    public function __construct(MessageBusInterface $bus, RentalRepository $rentalRepository)
    {
        $this->bus = $bus;
        $this->rentalRepository = $rentalRepository;
    }

    #[Route('/send', name: 'app_contact_send')]
    public function sendMessage(
        Request $request
    ): JsonResponse {
        if ($request->isXmlHttpRequest()) {
            if ($request->request->get('name')
                && $request->request->get('firstname')
                && $request->request->get('phone')
                && $request->request->get('email')
                && $request->request->get('subject')
                && $request->request->get('message')
                && $request->request->get('id_rental')
                && $request->request->get('title_rental')
            ) {
                $rental = $this->rentalRepository->find($request->request->get('id_rental'));
                $this->bus->dispatch(
                    new MailContact(
                        $request->request->get('email'),
                        $request->request->get('name'),
                        $request->request->get('firstname'),
                        $request->request->get('phone'),
                        $request->request->get('subject'),
                        $request->request->get('message'),
                        intval($request->request->get('id_rental')),
                        $request->request->get('title_rental'),
                        $rental->getUserOwner()->getEmail()
                    )
                );
                $message = [
                    'message' => 'Votre message nous a bien été transmis. Nous vous répondrons dans les plus brefs délais. Merci.'
                ];

                return new JsonResponse($message, Response::HTTP_OK, []);
            } else {
                $message = [
                    'message' => 'Veuillez remplir tous les champs obligatoires.'
                ];

                return new JsonResponse($message, Response::HTTP_NO_CONTENT, []);
            }
        } else {
            $message = [
                'message' => Response::HTTP_BAD_REQUEST . ' - ' . 'Un problème est survenu lors de l\'envoi de votre message.'
            ];
            return new JsonResponse($message, Response::HTTP_BAD_REQUEST, []);
        }
    }
}
