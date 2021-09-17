###################
Sistem Login berbasis Codeigniter3
###################

Aplikasi ini menggunakan fitur 
-  `1. Login dan Register
-  `2. Fitur multi user level.
-  `3. Mengatur menu yang bisa diakses user sesuai rolenya.
-  `4. Edit Profile
-  `5. Aktivasi Email
-  `6. Forgot password

*******************
Database
*******************

Gunakan file database login_master.sql yang sudah ada di file.

**************************
Login 
**************************

Untuk login admin gunakan akun email: coba@gmail.com, password: baihaqi. 
Untuk login user gunakan akun email: john@gmail.com, password: john

*******************
Set Email
*******************
Jika ingin login, register, dan forgot password. Ubah $config dan 
```
$this->email->from
```
seperti gambar pada link
(https://user-images.githubusercontent.com/43463075/133810933-6dfe3edc-75d5-48ef-bd14-75a77daa53d9.png)

************
Email security
************
Aktifkan akses pada gmail 
(https://user-images.githubusercontent.com/43463075/133816905-b5015ba9-45f4-43bd-b1e5-c254f16f8f85.png)

