<?php


namespace App\Message;


class MailContact
{
    private string $email;
    private string $name;
    private string $firstname;
    private string $phone;
    private string $subject;
    private string $content;
    private int $id_rental;
    private string $title_rental;
    private string $destinataire;

    public function __construct(
        string $email,
        string $name,
        string $firstname,
        string $phone,
        string $subject,
        string $content,
        int $id_rental,
        string $title_rental,
        string $destinataire
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->content = $content;
        $this->id_rental = $id_rental;
        $this->title_rental = $title_rental;
        $this->destinataire = $destinataire;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getIdRental(): int
    {
        return $this->id_rental;
    }

    public function getTitleRental(): string
    {
        return $this->title_rental;
    }

    public function getDestinataire(): string
    {
        return $this->destinataire;
    }
}