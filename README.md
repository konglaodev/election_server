ວິທີຕິດຕັ້ງ backend API ຂອງ project 
- ຕິດຕັ້ງ node js 
- ຕິດຕັ້ງ composer 
- ຕິດຕັ້ງ xampp 
- ຕິດຕັ້ງ postman ເພື່ອທົດສອບ API
- clone project : git clone https://github.com/konglaodev/election_server.git
- ເປີດ folder ທີ່ clone ກ່ອນໜ້າ ດ້ວຍ visual studio code 
ເປິດ terminal ຂຶ້ນມາ ພິມຄຳສັ່ງ ຕໍ່ໃປນີ້
- composer install 
- php artisan key:generate
- config database .env ປ່ຽນ ຊື່ database username password host ໃຫ້ຖຶກຕາມເຄື່ອງ serve ຂອງໂຕເອງ
ຫຼັງຈາກນັ້ນ ສືບຕໍ່
- php artisan migrate
- php artisan db:seed

ແລະ ນຳໃຊ້ jwt ( laravel passport ) 
- php artisan passport:install
ຈະໄດ້ publickey and private key copy key ເອົາໃປແທນໃສ່ key ທີ່ຢູ່ ໃນ file ApiAuthentication.php
run project 
- php artisan serve
- php artisan serve --port 8001 // ສຳຫຼັບ login
- ນຳໃຊ້ postman ທົດສອບ
