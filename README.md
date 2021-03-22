
  

  

  

## Scheduling Appointments
Para visualizar a aplicação em funcionamento basta acessar o link [Scheduling Appointments](http://scheduling-ppointments.herokuapp.com/)
#### Seguem os passos para rodar a aplicação
 1. rodar as migrations  => php artisan migrate:fresh
 2. rodar a seed de crendenciais => php artisan db:seed
 OBS: antes navegar até `Database\Seeders\`CredentialsSeeder
 e na chave token inserir o Token para utilizar a api Feegow
#### Packages Javascript
- [ ] Vue Toast Notification => npm install vue-toast-notification
- [ ] Vue Datetime => npm install --save luxon vue-datetime weekstart