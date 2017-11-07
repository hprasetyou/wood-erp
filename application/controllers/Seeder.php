<?php

class Seeder extends CI_Controller
{


    function seed_customer(){
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));
        $faker->addProvider(new Faker\Provider\en_US\Payment($faker));
        
        for ($i=0; $i < 20 ; $i++) { 
            # code...
            $customer = new Customer();
            $customer->setName($faker->name());
            $customer->setAddress($faker->address());
            $customer->setPhone($faker->phoneNumber());
            $customer->setWebsite($faker->url());
            $customer->setFax($faker->e164PhoneNumber());
            $customer->setImage($faker->imageUrl($width = 640, $height = 480));
            $customer->setBankDetail($this->input->post('BankDetail'));
            $customer->setTaxNumber($faker->bankAccountNumber());
            $customer->save();
        }

    }
}
