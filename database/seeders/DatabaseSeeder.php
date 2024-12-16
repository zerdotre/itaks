<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name'  => 'IsmailAbi',
            'email' => 'ismailabi@taxi-reserveren.com',
            'role'  => 'admin',
            'password'  => Hash::make('tPcu9xzz8igHKW'),
        ]);

        \App\Models\User::factory()->create([
            'name'  => 'Test Klant',
            'phone'  => '0612345678',
            'email' => 'akyaren70@gmail.com',
            'role'  => 'user',
            'password'  => Hash::make('12345678'),
        ]);

        \App\Models\Vehicle::factory()->create([
            'id'            => 1,
            'name'          => 'Stationcar',
            'price_km'      => 140,
            'price_min'     => 40,
            'price_start'   => 339,
            'price_waypoint'=> 750,
            'price_minimum' => 3400,
            'max_people'    => 4,
            'max_luggage'   => 4,
            'max_handluggage'   => 4,
            'max_combined_luggage'   => 6,
            'label_1'       => 'tot 4 personen',
            'label_2'       => 'Altijd een privé-taxi',
            'label_3'       => 'Bagage gratis mee',
            'label_4'       => 'Luxe & Comfort',
        ]);

        \App\Models\Vehicle::factory()->create([
            'id'            => 2,
            'name'          => 'Bus',
            'price_km'      => 180,
            'price_min'     => 45,
            'price_start'   => 339,
            'price_waypoint'=> 1000,
            'price_minimum' => 4500,
            'max_people'    => 7,
            'max_luggage'   => 6,
            'max_handluggage'   => 6,
            'max_combined_luggage'   => 10,
            'label_1'       => 'tot 7 personen',
            'label_2'       => 'Altijd een privé-taxi',
            'label_3'       => 'Bagage gratis mee',
            'label_4'       => 'Luxe & Comfort',
        ]);

        \App\Models\Place::factory()->create(['id' => 1, 'name' => 'Aerdenhout', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 2,'name' => 'Alblasserdam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 3,'name' => 'Alkmaar', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 4,'name' => 'Amersfoort', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 5,'name' => 'Amsterdam-Noord', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 6,'name' => 'Amsterdam-Oost', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 7,'name' => 'Amsterdam-West', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 8,'name' => 'Amsterdam-Zuid', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 9,'name' => 'Amsterdam-Zuidoost', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 10,'name' => 'Apeldoorn', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 11,'name' => 'Assendelft', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 12,'name' => 'Baarn', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 13,'name' => 'Barendrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 14,'name' => 'Barneveld', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 15,'name' => 'Beemster', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 16,'name' => 'Bennebroek', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 17,'name' => 'Bentveld', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 18,'name' => 'Bergen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 19,'name' => 'Berkel en Rodenrijs', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 20,'name' => 'Beverwijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 21,'name' => 'Blaricum', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 22,'name' => 'Bloemendaal', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 23,'name' => 'Bodegraven', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 24,'name' => 'Bovenkarspel', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 25,'name' => 'Castricum', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 26,'name' => 'Cruquius', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 27,'name' => 'De Kwakel', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 28,'name' => 'Delft', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 29,'name' => 'Den Helder', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 30,'name' => 'Diemen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 31,'name' => 'Enkhuizen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 32,'name' => 'Gouda', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 33,'name' => 'Haarlem', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 34,'name' => 'Halfweg', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 35,'name' => 'Heemskerk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 36,'name' => 'Heemstede', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 37,'name' => 'Heerhugowaard', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 38,'name' => 'Heiloo', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 39,'name' => 'Hillegom', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 40,'name' => 'Hoofddorp', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 41,'name' => 'Hoogkarspel', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 42,'name' => 'Hoorn', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 43,'name' => 'Houten', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 44,'name' => 'IJmuiden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 45,'name' => 'IJsselstein', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 46,'name' => 'Katwijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 47,'name' => 'Krommenie', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 48,'name' => 'Leiden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 49,'name' => 'Leiderdorp', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 50,'name' => 'Leidschendam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 51,'name' => 'Leimuiden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 52,'name' => 'Lelystad', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 53,'name' => 'Lisse', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 54,'name' => 'Naaldwijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 55,'name' => 'Nieuwegein', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 56,'name' => 'Nieuwerkerk Ijssel', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 57,'name' => 'Nijkerk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 58,'name' => 'Noordwijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 59,'name' => 'Noordwijkerhout', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 60,'name' => 'Oegstgeest', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 61,'name' => 'Overveen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 62,'name' => 'Purmerend', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 63,'name' => 'Rijsenhout', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 64,'name' => 'Rijswijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 65,'name' => 'Rotterdam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 66,'name' => 'Santpoort-Noord', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 67,'name' => 'Santpoort-Zuid', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 68,'name' => 'Sassenheim', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 69,'name' => 'Schagen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 70,'name' => 'Schiedam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 71,'name' => 'Sliedrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 72,'name' => 'Spaarndam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 73,'name' => 'Ter Aar', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 74,'name' => 'Uitgeest', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 75,'name' => 'Utrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 76,'name' => 'Velsen-Noord', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 77,'name' => 'Velsen-Zuid', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 78,'name' => 'Velserbroek', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 79,'name' => 'Vijfhuizen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 80,'name' => 'Vlaardingen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 81,'name' => 'Volendam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 82,'name' => 'Voorburg', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 83,'name' => 'Voorhout', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 84,'name' => 'Voorschoten', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 85,'name' => 'Waddinxveen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 86,'name' => 'Wassenaar', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 87,'name' => 'Zaandam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 88,'name' => 'Zandvoort', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 89,'name' => 'Zoetermeer', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 90,'name' => 'Zoeterwoude', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 91,'name' => 'Zwijndrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 92,'name' => 'Aalsmeer', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 93,'name' => 'Abcoude', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 94,'name' => 'Almere-Buiten', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 95,'name' => 'Almere-Hout', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 96,'name' => 'Almere', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 97,'name' => 'Alphen aan den Rijn', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 98,'name' => 'Amstelhoek', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 99,'name' => 'Amstelveen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 100,'name' => 'Badhoevedorp', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 101,'name' => 'Bilthoven', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 102,'name' => 'Breukelen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 103,'name' => 'Bussum', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 104,'name' => 'Eemnes', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 105,'name' => 'Hilversum', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 106,'name' => 'Huizen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 107,'name' => 'Laren', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 108,'name' => 'Maarssen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 109,'name' => 'Mijdrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 110,'name' => 'Monnickendam', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 111,'name' => 'Muiden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 112,'name' => 'Naarden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 113,'name' => 'Nieuw-Vennep', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 114,'name' => 'Nieuwkoop', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 115,'name' => 'Ouderkerk aan de Amstel', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 116,'name' => 'Schiphol-Rijk', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 117,'name' => 'Soest', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 118,'name' => 'Uithoorn', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 119,'name' => 'Vinkeveen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 120,'name' => 'Weesp', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 121,'name' => 'Wilnis', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 122,'name' => 'Woerden', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 123,'name' => 'Almere poort', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 124,'name' => 'Ankeveen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 125,'name' => 'Baambrugge', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 126,'name' => 'Kockengen', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 127,'name' => 'Kortenhoef', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 128,'name' => 'Kudelstaart', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 129,'name' => 'Loenen aan de vecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 130,'name' => 'Loosdrecht', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 131,'name' => 'Nederhorst den berg', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 132,'name' => 'Nieuwer ter aan', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 133,'name' => '\'s-Graveland', 'type' => 'place']);
        \App\Models\Place::factory()->create(['id' => 134,'name' => 'Vreeland', 'type' => 'place']);

        \App\Models\Place::factory()->create(['id' => 135,'name' => '1380', 'type' => 'zipcode']);
        \App\Models\Place::factory()->create(['id' => 136,'name' => '1381', 'type' => 'zipcode']);
        \App\Models\Place::factory()->create(['id' => 137,'name' => '1382', 'type' => 'zipcode']);
        \App\Models\Place::factory()->create(['id' => 138,'name' => '1383', 'type' => 'zipcode']);
        \App\Models\Place::factory()->create(['id' => 139,'name' => '1384', 'type' => 'zipcode']);



        // stationcar
        DB::table('place_vehicle')->insert(
            [
                ['place_id' => 1, 'vehicle_id' => 1, 'price' =>4500],
                ['place_id' => 2, 'vehicle_id' => 1, 'price' =>10000],
                ['place_id' => 3, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 4, 'vehicle_id' => 1, 'price' => 9000],
                ['place_id' => 5, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 6, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 7, 'vehicle_id' => 1, 'price' => 3400],
                ['place_id' => 8, 'vehicle_id' => 1, 'price' => 3400],
                ['place_id' => 9, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 10, 'vehicle_id' => 1, 'price' => 14400],
                ['place_id' => 11, 'vehicle_id' => 1, 'price' => 5900],
                ['place_id' => 12, 'vehicle_id' => 1, 'price' => 8000],
                ['place_id' => 13, 'vehicle_id' => 1, 'price' => 11500],
                ['place_id' => 14, 'vehicle_id' => 1, 'price' => 10000],
                ['place_id' => 15, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 16, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 17, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 18, 'vehicle_id' => 1, 'price' => 8000],
                ['place_id' => 19, 'vehicle_id' => 1, 'price' => 8000],
                ['place_id' => 20, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 21, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 22, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 23, 'vehicle_id' => 1, 'price' => 6900],
                ['place_id' => 24, 'vehicle_id' => 1, 'price' => 10900],
                ['place_id' => 25, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 26, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 27, 'vehicle_id' => 1, 'price' => 4000],
                ['place_id' => 28, 'vehicle_id' => 1, 'price' => 8000],
                ['place_id' => 29, 'vehicle_id' => 1, 'price' => 14000],
                ['place_id' => 30, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 31, 'vehicle_id' => 1, 'price' => 10900],
                ['place_id' => 32, 'vehicle_id' => 1, 'price' => 8500],
                ['place_id' => 33, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 34, 'vehicle_id' => 1, 'price' => 4000],
                ['place_id' => 35, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 36, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 37, 'vehicle_id' => 1, 'price' => 8000],
                ['place_id' => 38, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 39, 'vehicle_id' => 1, 'price' => 4900],
                ['place_id' => 40, 'vehicle_id' => 1, 'price' => 3900],
                ['place_id' => 41, 'vehicle_id' => 1, 'price' => 10900],
                ['place_id' => 42, 'vehicle_id' => 1, 'price' => 8500],
                ['place_id' => 43, 'vehicle_id' => 1, 'price' => 9000],
                ['place_id' => 44, 'vehicle_id' => 1, 'price' => 5400],
                ['place_id' => 45, 'vehicle_id' => 1, 'price' => 7900],
                ['place_id' => 46, 'vehicle_id' => 1, 'price' => 5900],
                ['place_id' => 47, 'vehicle_id' => 1, 'price' => 6400],
                ['place_id' => 48, 'vehicle_id' => 1, 'price' => 6900],
                ['place_id' => 49, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 50, 'vehicle_id' => 1, 'price' => 6900],
                ['place_id' => 51, 'vehicle_id' => 1, 'price' => 4000],
                ['place_id' => 52, 'vehicle_id' => 1, 'price' => 10900],
                ['place_id' => 53, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 54, 'vehicle_id' => 1, 'price' => 8400],
                ['place_id' => 55, 'vehicle_id' => 1, 'price' => 7900],
                ['place_id' => 56, 'vehicle_id' => 1, 'price' => 9000],
                ['place_id' => 57, 'vehicle_id' => 1, 'price' => 10900],
                ['place_id' => 58, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 59, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 60, 'vehicle_id' => 1, 'price' => 5400],
                ['place_id' => 61, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 62, 'vehicle_id' => 1, 'price' => 6400],
                ['place_id' => 63, 'vehicle_id' => 1, 'price' => 3400],
                ['place_id' => 64, 'vehicle_id' => 1, 'price' => 8900],
                ['place_id' => 65, 'vehicle_id' => 1, 'price' => 10400],
                ['place_id' => 66, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 67, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 68, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 69, 'vehicle_id' => 1, 'price' => 9500],
                ['place_id' => 70, 'vehicle_id' => 1, 'price' => 9500],
                ['place_id' => 71, 'vehicle_id' => 1, 'price' => 13000],
                ['place_id' => 72, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 73, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 74, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 75, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 76, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 77, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 78, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 79, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 80, 'vehicle_id' => 1, 'price' => 9500],
                ['place_id' => 81, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 82, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 83, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 84, 'vehicle_id' => 1, 'price' => 6900],
                ['place_id' => 85, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 86, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 87, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 88, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 89, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 90, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 91, 'vehicle_id' => 1, 'price' => 11500],
                ['place_id' => 92, 'vehicle_id' => 1, 'price' => 3400],
                ['place_id' => 93, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 94, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 95, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 96, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 97, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 98, 'vehicle_id' => 1, 'price' => 4000],
                ['place_id' => 99, 'vehicle_id' => 1, 'price' => 3400],
                ['place_id' => 100, 'vehicle_id' => 1, 'price' => 3500],
                ['place_id' => 101, 'vehicle_id' => 1, 'price' => 8400],
                ['place_id' => 102, 'vehicle_id' => 1, 'price' => 5400],
                ['place_id' => 103, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 104, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 105, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 106, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 107, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 108, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 109, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 110, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 111, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 112, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 113, 'vehicle_id' => 1, 'price' => 4900],
                ['place_id' => 114, 'vehicle_id' => 1, 'price' => 5400],
                ['place_id' => 115, 'vehicle_id' => 1, 'price' => 3900],
                ['place_id' => 116, 'vehicle_id' => 1, 'price' => 3500],
                ['place_id' => 117, 'vehicle_id' => 1, 'price' => 7500],
                ['place_id' => 118, 'vehicle_id' => 1, 'price' => 4500],
                ['place_id' => 119, 'vehicle_id' => 1, 'price' => 5000],
                ['place_id' => 120, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 121, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 122, 'vehicle_id' => 1, 'price' => 7000],
                ['place_id' => 123, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 124, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 125, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 126, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 127, 'vehicle_id' => 1, 'price' => 6000],
                ['place_id' => 128, 'vehicle_id' => 1, 'price' => 4000],
                ['place_id' => 129, 'vehicle_id' => 1, 'price' => 5400],
                ['place_id' => 130, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 131, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 132, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 133, 'vehicle_id' => 1, 'price' => 6500],
                ['place_id' => 134, 'vehicle_id' => 1, 'price' => 5400],
                
                ['place_id' => 135, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 136, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 137, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 138, 'vehicle_id' => 1, 'price' => 5500],
                ['place_id' => 139, 'vehicle_id' => 1, 'price' => 5500],
            ]
        );

        //busprijzen
        DB::table('place_vehicle')->insert(
            [
                ['place_id' =>1, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>2, 'vehicle_id' => 2, 'price' => 11500],
                ['place_id' =>3, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>4, 'vehicle_id' => 2, 'price' => 10400],
                ['place_id' =>5, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>6, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>7, 'vehicle_id' => 2, 'price' => 5000],
                ['place_id' =>8, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>9, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>10, 'vehicle_id' => 2, 'price' => 16400],
                ['place_id' =>11, 'vehicle_id' => 2, 'price' => 6900],
                ['place_id' =>12, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>13, 'vehicle_id' => 2, 'price' => 13500],
                ['place_id' =>14, 'vehicle_id' => 2, 'price' => 11500],
                ['place_id' =>15, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>16, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>17, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>18, 'vehicle_id' => 2, 'price' => 9500],
                ['place_id' =>19, 'vehicle_id' => 2, 'price' => 9500],
                ['place_id' =>20, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>21, 'vehicle_id' => 2, 'price' => 8500],
                ['place_id' =>22, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>23, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>24, 'vehicle_id' => 2, 'price' => 12400],
                ['place_id' =>25, 'vehicle_id' => 2, 'price' => 8500],
                ['place_id' =>26, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>27, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>28, 'vehicle_id' => 2, 'price' => 9500],
                ['place_id' =>29, 'vehicle_id' => 2, 'price' => 16000],
                ['place_id' =>30, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>31, 'vehicle_id' => 2, 'price' => 12500],
                ['place_id' =>32, 'vehicle_id' => 2, 'price' => 10000],
                ['place_id' =>33, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>34, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>35, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>36, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>37, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>38, 'vehicle_id' => 2, 'price' => 8500],
                ['place_id' =>39, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>40, 'vehicle_id' => 2, 'price' => 5000],
                ['place_id' =>41, 'vehicle_id' => 2, 'price' => 12400],
                ['place_id' =>42, 'vehicle_id' => 2, 'price' => 11000],
                ['place_id' =>43, 'vehicle_id' => 2, 'price' => 10400],
                ['place_id' =>44, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>45, 'vehicle_id' => 2, 'price' => 9500],
                ['place_id' =>46, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>47, 'vehicle_id' => 2, 'price' => 7900],
                ['place_id' =>48, 'vehicle_id' => 2, 'price' => 7900],
                ['place_id' =>49, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>50, 'vehicle_id' => 2, 'price' => 7900],
                ['place_id' =>51, 'vehicle_id' => 2, 'price' => 5000],
                ['place_id' =>52, 'vehicle_id' => 2, 'price' => 12400],
                ['place_id' =>53, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>54, 'vehicle_id' => 2, 'price' => 9400],
                ['place_id' =>55, 'vehicle_id' => 2, 'price' => 8900],
                ['place_id' =>56, 'vehicle_id' => 2, 'price' => 10400],
                ['place_id' =>57, 'vehicle_id' => 2, 'price' => 12400],
                ['place_id' =>58, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>59, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>60, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>61, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>62, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>63, 'vehicle_id' => 2, 'price' => 4900],
                ['place_id' =>64, 'vehicle_id' => 2, 'price' => 9900],
                ['place_id' =>65, 'vehicle_id' => 2, 'price' => 11900],
                ['place_id' =>66, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>67, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>68, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>69, 'vehicle_id' => 2, 'price' => 11500],
                ['place_id' =>70, 'vehicle_id' => 2, 'price' => 10900],
                ['place_id' =>71, 'vehicle_id' => 2, 'price' => 14400],
                ['place_id' =>72, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>73, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>74, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>75, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>76, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>77, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>78, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>79, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>80, 'vehicle_id' => 2, 'price' => 11500],
                ['place_id' =>81, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>82, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>83, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>84, 'vehicle_id' => 2, 'price' => 7900],
                ['place_id' =>85, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>86, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>87, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>88, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>89, 'vehicle_id' => 2, 'price' => 9000],
                ['place_id' =>90, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>91, 'vehicle_id' => 2, 'price' => 13000],
                ['place_id' =>92, 'vehicle_id' => 2, 'price' => 4400],
                ['place_id' =>93, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>94, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>95, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>96, 'vehicle_id' => 2, 'price' => 7900],
                ['place_id' =>97, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>98, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>99, 'vehicle_id' => 2, 'price' => 4500],
                ['place_id' =>100, 'vehicle_id' => 2, 'price' => 5000],
                ['place_id' =>101, 'vehicle_id' => 2, 'price' => 9400],
                ['place_id' =>102, 'vehicle_id' => 2, 'price' => 6900],
                ['place_id' =>103, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>104, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>105, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>106, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>107, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>108, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>109, 'vehicle_id' => 2, 'price' => 6500],
                ['place_id' =>110, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>111, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>112, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>113, 'vehicle_id' => 2, 'price' => 5900],
                ['place_id' =>114, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>115, 'vehicle_id' => 2, 'price' => 4500],
                ['place_id' =>116, 'vehicle_id' => 2, 'price' => 4500],
                ['place_id' =>117, 'vehicle_id' => 2, 'price' => 8500],
                ['place_id' =>118, 'vehicle_id' => 2, 'price' => 6000],
                ['place_id' =>119, 'vehicle_id' => 2, 'price' => 6400],
                ['place_id' =>120, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>121, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>122, 'vehicle_id' => 2, 'price' => 8400],
                ['place_id' =>123, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>124, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>125, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>126, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>127, 'vehicle_id' => 2, 'price' => 7500],
                ['place_id' =>128, 'vehicle_id' => 2, 'price' => 5500],
                ['place_id' =>129, 'vehicle_id' => 2, 'price' => 6900],
                ['place_id' =>130, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>131, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>132, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' =>133, 'vehicle_id' => 2, 'price' => 8000],
                ['place_id' =>134, 'vehicle_id' => 2, 'price' => 6900],

                ['place_id' => 135, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' => 136, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' => 137, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' => 138, 'vehicle_id' => 2, 'price' => 7000],
                ['place_id' => 139, 'vehicle_id' => 2, 'price' => 7000],
            ]
        );







    }
}