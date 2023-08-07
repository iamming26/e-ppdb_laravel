<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PPDB SMK</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-image: url('https://www.smksriwijayakrpc.sch.id/upload/picture/62924340Slide2.JPG');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-info">
                                        <h1 class="text-center"><i class="fa-solid fa-unlock-keyhole"></i></h1>
                                        {{-- <h5 class="text-center font-weight-light">Login</h5> --}}
                                        <h5 class="text-center font-weight-light">Login<br>SMK Sriwijaya - Tahun {{ date('Y') }}</h5>
                                    </div>
                                    <div class="card-body">

                                        @include('components.alerts')

                                        <form action="{{ route('authenticate') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email anda">
                                            </div>
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="**********">
                                            </div>
                                            @csrf
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
