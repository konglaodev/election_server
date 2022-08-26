ວິທີຕິດຕັ້ງ backend API ຂອງ project 
1 ຕິດຕັ້ງ node js 
2 ຕິດຕັ້ງ composer 
3 ຕິດຕັ້ງ xampp 
4 ຕິດຕັ້ງ postman ເພື່ອທົດສອບ API
5 clone project : git clone git@github.com:konglaodev/election_server.git
6 ເປີດ folder ທີ່ clone ກ່ອນໜ້າ ດ້ວຍ visual studio code 
ເປິດ terminal ຂຶ້ນມາ ພິມຄຳສັ່ງ ຕໍ່ໃປນີ້
- composer install 
- php artisan key:generate
7 config database .env ປ່ຽນ ຊື່ database username password host ໃຫ້ຖຶກຕາມເຄື່ອງ serve ຂອງໂຕເອງ
ຫຼັງຈາກນັ້ນ ສືບຕໍ່
- php artisan migrate
- php artisan db:seed

ແລະ ນຳໃຊ້ jwt ( laravel passport ) 
- php artisan passport:install
ຈະໄດ້ publickey and private key copy key ເອົາໃປແທນໃສ່ key ທີ່ຢູ່ ໃນ file ApiAuthentication.php

8 ນຳໃຊ້ postman ທົດສອບ
