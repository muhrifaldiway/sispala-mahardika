<?php

class PublicProfilController extends Controller
{
    public function index()
    {
        $model = new ProfilOrganisasi();

        $profil = $model->get();

        if (!$profil) {
            $profil = [];
        }

        $this->view(
            'public/profil',
            [
                'profil' => $profil
            ]
        );
    }
}