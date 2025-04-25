<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="login-container text-center">
        <h3 class="mb-4"><strong>APLIKASI GUDANG</strong></h3>
        <form action="process_login.php" method="POST" onsubmit="return validateForm()">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="username" id="username" placeholder="username">
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
               <div class="mb-3"><!-- membuat form checkbox dengan perintah menjalankan function showHide() saat diklik -->
            <input type="checkbox" onclick="showHide()"> Tampilkan Password
            </div>      
            <a href="register.php" class="btn btn-register w-100 mb-2">DAFTAR</a>
            <button type="submit" class="btn btn-login w-100">LOGIN</button>
        </form>
    </div>

    <script>
        function showHide() {
  var inputan = document.getElementById("password");
  if (inputan.type === "password") {
    inputan.type = "text";
  } else {
    inputan.type = "password";
  }
} 
        function validateForm() {
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            if (username === "" || password === "") {
                alert("username dan Password wajib diisi!");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
