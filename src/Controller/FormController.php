<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Form\MyRandomForm;

class FormController extends AbstractController
{

    public function show()
    {
        var_dump($_POST);
        $form = new MyRandomForm();
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->twig->render("Form/result.html.twig", [
                "text" => $_POST["text"],
                "integer" => $_POST["integer"],
                "choice" => $_POST["choice"],
                "wasRedChosen" => isset($_POST['red']),
                "wasYellowChosen" => isset($_POST['yellow']),
                "wasGreenChosen" => isset($_POST['green'])
            ]);
        }
        return $this->twig->render('Form/show.html.twig', [
            "form" => $form
        ]);
    }
}
