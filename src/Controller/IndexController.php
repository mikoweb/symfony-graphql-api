<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class IndexController extends AbstractController
{
    #[IsGranted('ROLE_API_USER')]
    public function index(): Response
    {
        throw $this->createAccessDeniedException();
    }
}
