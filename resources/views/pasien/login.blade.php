<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<div class="wrapper vh-100 d-flex flex-column justify-content-center align-items-center"
     style="background-color: #48829E;">
    <div class="cards border px-5 py-3 rounded-lg" style="width: 30%; background-color: white;">
        <div class="text-group my-4 d-flex flex-column justify-content-center align-items-center">
            <img src="../../../images/hospital-health-clinic-svgrepo-com.svg" style="width: 20%;"
                 class="text-center w-25 my-3" alt="">
            <h3 class="text-center text-capitalize">Login</h3>
        </div>
        <form action="/pasien/login" method="POST">
            @csrf
            @method('POST')
            <div class="form-group my-4 gap-3">
                <input type="email" class="w-100 px-4 py-3 my-3 rounded-lg border page-link" id="email"
                       placeholder="email" autocomplete="off" name="email" required>
                <input type="password" class="w-100 px-4 py-3 my-3 rounded-lg border page-link" id="password"
                       placeholder="Password" name="password" required>
                <a href="#"
                   class="fst-normal link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Lupa
                    Password?</a>
            </div>
            <div>
                @error('error')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <p class="text-secondary my-5">Gunakan akun anda yang sudah anda daftarkan sebelumnya untuk bisa melakukan
                login</p>
            <div class="form-group d-flex justify-content-between align-items-center">
                <a href={{url('/pasien/register')}} class="link-offset-2 link-offset-3-hover link-underline
                   link-underline-opacity-0 link-underline-opacity-75-hover">Buat Akun</a>
                <button type="submit" class="w-25 btn btn-block rounded-2 text-white"
                        style="background-color: #48829E;">Login
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3 class=" mt-3
"/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0116028855.js" crossorigin="anonymous"></script>
</body>

</html>
