<?php

class PublicController extends Controller
{
    public function index()
    {
        $profil = (new ProfilOrganisasi())->get() ?: [];
        $pengaturan = (new Pengaturan())->get() ?: [];

        $this->view(
            'public/beranda/index',
            [
                'profil' => $profil,
                'pengaturan' => $pengaturan,
                'galeri' => array_slice((new Gallery())->getAll(), 0, 6),
                'berita' => (new Berita())->latest(3),
                'jumlahAnggota' => (int) (new Anggota())->count()
            ]
        );
    }
}
