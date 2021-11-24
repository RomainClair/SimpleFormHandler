<?php

declare(strict_types=1);

namespace App\Form;

class MyRandomForm
{
    private bool $isSubmitted = false;
    private array $errors = [];

    public function isSubmitted(): bool
    {
        $this->isSubmitted = filter_has_var(INPUT_POST, "text") &&
        filter_has_var(INPUT_POST, "integer") &&
        filter_has_var(INPUT_POST, "date") &&
        filter_has_var(INPUT_POST, "url") &&
        filter_has_var(INPUT_POST, "choice") &&
        filter_has_var(INPUT_POST, "range");
        return $this->isSubmitted;
    }

    public function isValid(): bool
    {
        if (!$this->isSubmitted) {
            return false;
        }
        $result = $this->validateText();
        $result = $this->validateInteger() && $result;
        $result = $this->validateChoice() && $result;
        return  $result;
    }

    public function getError(string $field): array
    {
        if (isset($this->errors[$field])) {
            return $this->errors[$field];
        }
        return [];
    }

    private function validateText(): bool
    {
        if (empty($_POST["text"])) {
            $this->errors["text"][] = "Le champs texte ne doit pas être vide";
            return false;
        }
        if (strlen($_POST["text"]) > 255) {
            $this->errors["text"][] = "Le champs texte doit faire moins de 255 caractères";
            return false;
        }
        return true;
    }

    private function validateInteger(): bool
    {
        if (empty($_POST["integer"])) {
            $this->errors["integer"][] = "Le champs entier ne doit pas être vide";
            return false;
        }
        if (!is_numeric($_POST["integer"])) {
            $this->errors["integer"][] = "Le champs doit être un entier";
            return false;
        }
        if ($_POST["integer"] <= 0) {
            $this->errors["integer"][] = "L'entier choisi doit être positif";
            return false;
        }
        return true;
    }

    private function validateChoice(): bool
    {
        if ($_POST["choice"] !== "Yes" && $_POST["choice"] !== "No" && $_POST["choice"] !== "Maybe") {
            $this->errors["choice"][] = "Votre choix doit être Oui, Non ou Peut-être";
            return false;
        }
        return true;
    }
}
