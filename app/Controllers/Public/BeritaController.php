<?php

class PublicBeritaController extends Controller
{
    public function index()
    {
        $keyword = trim(
            $_GET['q'] ?? ''
        );

        $page = max(
            1,
            (int) ($_GET['page'] ?? 1)
        );

        $perPage = 9;

        $offset =
            ($page - 1) * $perPage;


        $model = new Berita();


        $berita = $model->getAll(
            $keyword,
            $perPage,
            $offset
        );


        $total =
            $model->count($keyword);


        $totalPages =
            max(
                1,
                (int) ceil(
                    $total / $perPage
                )
            );


        $this->view(
            'public/berita/index',
            [
                'berita' => $berita,
                'keyword' => $keyword,
                'page' => $page,
                'totalPages' => $totalPages,
                'total' => $total
            ]
        );
    }


    public function detail($slug)
    {
        $model = new Berita();

        $berita =
            $model->findBySlug($slug);


        if (!$berita) {

            http_response_code(404);

            echo '<h1>404 - Berita Tidak Ditemukan</h1>';

            return;
        }


        $latest =
            $model->latest(3);


        $this->view(
            'public/berita/detail',
            [
                'berita' => $berita,
                'latest' => $latest
            ]
        );
    }
}