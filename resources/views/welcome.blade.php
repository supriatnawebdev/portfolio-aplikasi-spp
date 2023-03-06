


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body >
    <div class="container justify-content-center py-5 align-items-center">
        <div class="row d-flex justify-content-center">
            <div class="col-6 mt-3">
                <div class="py-3">

                    <h1 class="text-primary fw-bold">
                        Welcompe To
                    </h1>
                    <h2>
                        SYSYTEM SPP
                    </h2>
                    <h5>SMKN BANTARKALONG</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error assumenda rerum odio qui aliquid pariatur dolorum dignissimos possimus, porro repellendus.</p>
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 btn btn-primary ">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 btn btn-outline-primary px-3 py-1">Log in Admin</a>
                                    <a href="{{ route('show.login') }}" class="text-sm text-gray-700 dark:text-gray-500 btn btn-outline-primary px-3 py-1">Log in Siswa</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 btn btn-outline-primary px-3 py-1">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                </div>

                </div>
            </div>
            <div class="col-6 mt-3">
                <div class="">
                    <img src="https://blog.herzing.ca/hubfs/3d%20character%20at%20computer.jpg" alt="" srcset="" width="600px" class="rounded">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>



