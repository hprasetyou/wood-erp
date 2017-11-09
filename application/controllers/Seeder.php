<?php

class Seeder extends CI_Controller
{


    function __construct()
    {
      # code...
      parent::__construct();
      if(!$this->input->is_cli_request())
      {
        echo 'Not allowed';
        exit();
      }
      $this->faker = Faker\Factory::create();
      $this->faker->addProvider(new Faker\Provider\en_US\PhoneNumber($this->faker));
      $this->faker->addProvider(new Faker\Provider\Internet($this->faker));
      $this->faker->addProvider(new Faker\Provider\en_US\Payment($this->faker));

    }
    private $faker;

    function seed_customer(){

        for ($i=0; $i < 20 ; $i++) {
            # code...
            $customer = new Partner();
            $customer->setName($this->faker->name());
            $customer->setAddress($this->faker->address());
            $customer->setPhone($this->faker->phoneNumber());
            $customer->setWebsite($this->faker->url());
            $customer->setFax($this->faker->e164PhoneNumber());
            $customer->setImage($this->faker->imageUrl($width = 640, $height = 480));
            $customer->setBankDetail($this->input->post('BankDetail'));
            $customer->setTaxNumber($this->faker->bankAccountNumber());
            $customer->setIsCustomer(true);
            $customer->save();
        }

    }

    function seed_user($count){
        $options = [
          'cost' => 12,
        ];
        for ($i=0; $i < $count ; $i++) {
            # code...
            $employee = new Partner();
            $employee->setName($this->faker->name());
            $employee->setEmail($this->faker->freeEmail());
            $employee->setAddress($this->faker->address());
            $employee->setPhone($this->faker->phoneNumber());
            $employee->setFax($this->faker->e164PhoneNumber());
            $employee->setImage($this->faker->imageUrl($width = 640, $height = 480));
            $employee->setBankDetail($this->input->post('BankDetail'));
            $employee->setTaxNumber($this->faker->bankAccountNumber());
            $employee->setIsEmployee(true);
            print_r($employee);
            $employee->save();
            $user = new User();
            $user->setName($this->faker->userName());
            $user->setPassword(password_hash('0000000', PASSWORD_BCRYPT, $options));
            $user->setPartner($employee);
            $user->setStatus(true);
            $user->save();
        }

    }
}
