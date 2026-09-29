<?php

class PublicGaleriController extends Controller
{
    public function index()
    {
        $keyword = trim($_GET['q'] ?? '');

        $kategori = trim($_GET['kategori'] ?? '');

        $model = new Gallery();

        $galeri = $model->getAll(
            $keyword,
            $kategori
        );

        $categories = $model->getCategories();

        $this->view(
            'public/galeri',
            [
                'galeri' => $galeri,
                'categories' => $categories,
                'keyword' => $keyword,
                'kategori' => $kategori
            ]
        );
    }
}