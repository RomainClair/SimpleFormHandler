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
        if ($form->isSubmitted()) {
            echo "Formulaire à traiter";
        }
        return $this->twig->render('Form/show.html.twig');
    }
}
