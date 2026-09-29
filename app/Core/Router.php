
<?php

class Router
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Route
    |--------------------------------------------------------------------------
    */

    private $routes = [
        'GET'  => [],
        'POST' => []
    ];


    /*
    |--------------------------------------------------------------------------
    | GET Route
    |--------------------------------------------------------------------------
    */

    public function get($uri, $callback)
    {
        $this->routes['GET'][$uri] = $callback;
    }


    /*
    |--------------------------------------------------------------------------
    | POST Route
    |--------------------------------------------------------------------------
    */

    public function post($uri, $callback)
    {
        $this->routes['POST'][$uri] = $callback;
    }


    /*
    |--------------------------------------------------------------------------
    | Dispatch
    |--------------------------------------------------------------------------
    */

    public function dispatch($uri, $method)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Method
        |--------------------------------------------------------------------------
        */

        $method = strtoupper($method);

        if (!isset($this->routes[$method])) {

            http_response_code(405);

            echo '<h1>405 - Method Tidak Diizinkan</h1>';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Path URL
        |--------------------------------------------------------------------------
        */

        $path = parse_url(
            $uri,
            PHP_URL_PATH
        );


        /*
        |--------------------------------------------------------------------------
        | Hapus BASE_URL
        |--------------------------------------------------------------------------
        */

        $basePath = parse_url(
            BASE_URL,
            PHP_URL_PATH
        );


        if (
            $basePath &&
            $basePath !== '/' &&
            strpos($path, $basePath) === 0
        ) {

            $path = substr(
                $path,
                strlen($basePath)
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Normalisasi Path
        |--------------------------------------------------------------------------
        */

        $path = '/' . trim(
            $path,
            '/'
        );


        /*
        |--------------------------------------------------------------------------
        | ROUTE LANGSUNG
        |
        | Contoh:
        | /admin/anggota
        | /admin/anggota/create
        |--------------------------------------------------------------------------
        */

        if (
            isset(
                $this->routes[$method][$path]
            )
        ) {

            return $this->executeCallback(
                $this->routes[$method][$path],
                []
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ROUTE DENGAN PARAMETER
        |
        | Contoh:
        |
        | /admin/anggota/edit/{id}
        | /admin/anggota/update/{id}
        | /admin/anggota/delete/{id}
        |--------------------------------------------------------------------------
        */

        foreach (
            $this->routes[$method]
            as $route => $callback
        ) {

            /*
            |--------------------------------------------------------------
            | Cek apakah route memiliki parameter
            |--------------------------------------------------------------
            */

            if (
                strpos(
                    $route,
                    '{'
                ) === false
            ) {

                continue;
            }


            /*
            |--------------------------------------------------------------
            | Ubah {parameter} menjadi pattern
            |
            | {id} → ([^/]+)
            |--------------------------------------------------------------
            */

            $pattern = preg_replace(
                '#\{[^/]+\}#',
                '([^/]+)',
                $route
            );


            /*
            |--------------------------------------------------------------
            | Buat pattern lengkap
            |--------------------------------------------------------------
            */

            $pattern =
                '#^' .
                $pattern .
                '$#';


            /*
            |--------------------------------------------------------------
            | Cocokkan URL
            |--------------------------------------------------------------
            */

            if (
                preg_match(
                    $pattern,
                    $path,
                    $matches
                )
            ) {

                /*
                |----------------------------------------------------------
                | Hapus hasil full match
                |----------------------------------------------------------
                */

                array_shift(
                    $matches
                );


                /*
                |----------------------------------------------------------
                | Jalankan Controller
                |----------------------------------------------------------
                */

                return $this->executeCallback(
                    $callback,
                    $matches
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 404
        |--------------------------------------------------------------------------
        */

        http_response_code(404);

        echo '
            <div style="
                font-family:Arial;
                padding:40px;
                text-align:center;
            ">

                <h1>
                    404 - Halaman Tidak Ditemukan
                </h1>

                <p>
                    Route yang dicari:
                    <strong>'
                    . htmlspecialchars($path) .
                    '</strong>
                </p>

            </div>
        ';
    }


    /*
    |--------------------------------------------------------------------------
    | Execute Callback
    |--------------------------------------------------------------------------
    */

    private function executeCallback(
        $callback,
        $parameters = []
    ) {

        /*
        |--------------------------------------------------------------------------
        | Callback Controller
        |
        | Contoh:
        |
        | [
        |     'AnggotaAdminController',
        |     'edit'
        | ]
        |--------------------------------------------------------------------------
        */

        if (is_array($callback)) {

            $controllerClass =
                $callback[0];

            $methodName =
                $callback[1];


            /*
            |--------------------------------------------------------------
            | Cek apakah Controller tersedia
            |--------------------------------------------------------------
            */

            if (
                !class_exists(
                    $controllerClass
                )
            ) {

                http_response_code(500);

                echo '
                    <h1>
                        500 - Controller Tidak Ditemukan
                    </h1>

                    <p>
                        Controller:
                        <strong>'
                        . htmlspecialchars(
                            $controllerClass
                        )
                        . '</strong>
                    </p>
                ';

                return;
            }


            /*
            |--------------------------------------------------------------
            | Buat object Controller
            |--------------------------------------------------------------
            */

            $controller =
                new $controllerClass();


            /*
            |--------------------------------------------------------------
            | Cek Method Controller
            |--------------------------------------------------------------
            */

            if (
                !method_exists(
                    $controller,
                    $methodName
                )
            ) {

                http_response_code(500);

                echo '
                    <h1>
                        500 - Method Tidak Ditemukan
                    </h1>

                    <p>
                        Method:
                        <strong>'
                        . htmlspecialchars(
                            $methodName
                        )
                        . '</strong>
                    </p>
                ';

                return;
            }


            /*
            |--------------------------------------------------------------
            | Jalankan Method + Parameter
            |--------------------------------------------------------------
            */

            return call_user_func_array(
                [
                    $controller,
                    $methodName
                ],
                $parameters
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Callback Function Biasa
        |--------------------------------------------------------------------------
        */

        if (is_callable($callback)) {

            return call_user_func_array(
                $callback,
                $parameters
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Callback Tidak Valid
        |--------------------------------------------------------------------------
        */

        http_response_code(500);

        echo '
            <h1>
                500 - Callback Tidak Valid
            </h1>
        ';

    
    }

    
}

