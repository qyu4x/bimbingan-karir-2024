<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik | OKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<div style="background-color: #48829E;">
    <div class="container">
        <div class="row">
            <div class="row">
                <h3 class="mt-3 text-white">Poliklinik</h3 class="mt-3">
            </div>
            <div class="row d-flex justify-content-center mt-5 mb-5">
                <h1 class="text-center text-white">Sistem Temu Janji</h1>
                <h1 class="text-center text-white">Pasien - Dokter</h1>
                <p class="text-center text-white">Bimbingan Karir 2024 Web Development</p>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="container d-flex justify-content-between mt-5">
        <div class="col-5">
            <img src="../../images/user-svgrepo-com.svg" class="mb-3" style="width: 25%;" alt="">
            <div class="row">
                <h3>Login Sebagai Pasien</h3>
                <p>Apabila anda seorang pasien, silakan login terlebih dahulu untuk melakukan pendaftaran sebagai pasien!</p>
                <a href={{url('/pasien/login')}} class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Klik Link Berikut <span><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
        <div class="col-5">
            <img src="../../images/user-svgrepo-com.svg" class="mb-3" style="width: 25%;" alt="">
            <div class="row">
                <h3>Login Sebagai Dokter</h3>
                <p>Apabila anda seorang dokter, silakan login terlebih dahulu untuk memulai melayani pasien!</p>
                <a href="{{url('/dashboard/login')}}" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Klik Link Berikut <span><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3 class=" mt-3"/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0116028855.js" crossorigin="anonymous"></script>
</body>

</html>
