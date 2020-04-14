<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //Kepala BPS
            [
                'name'  => 'Drs. Dumangar Hutauruk M.Si',
                'email' => 'dumangar@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012535',
                'nip_panjang' => '196107091990031001',
                'jabatan_id' => '1'
            ],
            //BPS Kabupaten Banggai Kepulauan
            [
                'name'  => 'Rantau SE',
                'email' => 'rantau@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340014316',
                'nip_panjang' => '196408181994011002',
                'jabatan_id' => '2'
            ],
             //BPS Kabupaten Banggai
            [
                'name'  => 'Ir. Muhammad Said M.Si',
                'email' => 'muhsaid@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340014450',
                'nip_panjang' => '196708041994011001',
                'jabatan_id' => '2'
            ],
             //BPS Kabupaten Morowali
            [
                'name'  => 'Simon S.Si, MM',
                'email' => 'simon.antolis@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340011131',
                'nip_panjang' => '196605201985031001',
                'jabatan_id' => '2'
            ],
            //BPS Kabupaten Poso
            [
                'name'  => 'Ir. Yaslin Hendrita Tansala M.Si',
                'email' => 'yaslins@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013548',
                'nip_panjang' => '196604231993012001',
                'jabatan_id' => '2'
            ],
            //BPS Kabupaten Donggala
            [
                'name'  => 'Ir. Arfandi M.Si',
                'email' => 'arfandi@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012910',
                'nip_panjang' => '196508011991031003',
                'jabatan_id' => '2'
            ],
             //BPS Kabupaten Tolitoli
            [
                'name'  => 'Agus Paryanto SE',
                'email' => 'aguspary@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013687',
                'nip_panjang' => '196607171993031002',
                'jabatan_id' => '2'
            ],
            //BPS Kabupaten Tolitoli
            [
                'name'  => 'Ir. Muzakir',
                'email' => 'muz_akhir@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340014770',
                'nip_panjang' => '196506101994031002',
                'jabatan_id' => '2'
            ],
            //BPS Kabupaten Parigi Moutong
            [
                'name'  => 'Fatimah Bachmid SE',
                'email' => 'fatimah.bachmid@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013246',
                'nip_panjang' => '196208201992032004',
                'jabatan_id' => '2'
            ],
             //BPS Kabupaten Tojo Una Una
            [
                'name'  => 'Abd Samad Kadim S.Si',
                'email' => 'samad.kadim@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340010348',
                'nip_panjang' => '196212241983021001',
                'jabatan_id' => '2'
            ],
              //BPS Kabupaten Sigi
            [
                'name'  => 'Ir. Jefrie Wahido M.Si',
                'email' => 'jefriewahido@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013423',
                'nip_panjang' => '196702081992121001',
                'jabatan_id' => '2'
            ],
            //BPS Kota Palu
            [
                'name'  => 'Ir. Sutrisno S. Abusungut M.Si',
                'email' => 'sutrisno@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340014448',
                'nip_panjang' => '196907101994011001',
                'jabatan_id' => '2'
            ],

            //TU
            [
                'name'  => 'Sarmiati SE, M.P.W.',
                'email' => 'sarmiati@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340009554',
                'nip_panjang' => '196209141982032002',
                'jabatan_id' => '3'
            ],
            [
                'name'  => 'Luhur Partomo Hudoyo S.Si, M.Stat',
                'email' => 'luhurph@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340051207',
                'nip_panjang' => '198209232009021002',
                'jabatan_id' => '9'
            ],
            [
                'name'  => 'Muhammad Fauzan Akbar SST',
                'email' => 'fauzanakbar@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340017863',
                'nip_panjang' => '198311102006021004',
                'jabatan_id' => '29'
            ],
            [
                'name'  => 'Annisa Nur Kusuma SST',
                'email' => 'annisa.kusuma@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340057883',
                'nip_panjang' => '199506092017012001',
                'jabatan_id' => '29'
            ],
             [
                'name'  => 'Rika Ari Wulandari S.Psi',
                'email' => 'rikarie@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055434',
                'nip_panjang' => '198712152011012022',
                'jabatan_id' => '10'
            ],
            [
                'name'  => 'Salahudin SE',
                'email' => 'salahudin@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '589999999',
                'nip_panjang' => '197705052011011011',
                'jabatan_id' => '30'
            ],
            [
                'name'  => 'Abdul Wahab Murdan Abdullah SH',
                'email' => 'aw.murdan@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055410',
                'nip_panjang' => '198011112011011005',
                'jabatan_id' => '30'
            ],
            [
                'name'  => 'Lustiawaty Achmad SST',
                'email' => 'lustia@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340019249',
                'nip_panjang' => '198405022007012007',
                'jabatan_id' => '11'
            ],
            [
                'name'  => 'Masmah',
                'email' => 'masmah@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013288',
                'nip_panjang' => '197008111992032005',
                'jabatan_id' => '31'
            ],
            [
                'name'  => 'Murni S.Sos',
                'email' => 'murni@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055425',
                'nip_panjang' => '198608252011012014',
                'jabatan_id' => '31'
            ],
            [
                'name'  => 'Miftahul Ahyar S.Tr.Stat.',
                'email' => 'ahyarmf@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058834',
                'nip_panjang' => '199604042019011002',
                'jabatan_id' => '31'
            ],
            [
                'name'  => 'Robert Andries Gabriel SE',
                'email' => 'robert_ag@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012303',
                'nip_panjang' => '196909031989031002',
                'jabatan_id' => '12'
            ],
            [
                'name'  => 'Laabudin',
                'email' => 'laabudin@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340010851',
                'nip_panjang' => '196212081984031001',
                'jabatan_id' => '32'
            ],
            [
                'name'  => 'Enos Rombe',
                'email' => 'enos.rombe@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012207',
                'nip_panjang' => '196801161989031006',
                'jabatan_id' => '32'
            ],
            [
                'name'  => 'Muhammad Saiful',
                'email' => 'm.saiful@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340018378',
                'nip_panjang' => '198005092006041003',
                'jabatan_id' => '32'
            ],
            [
                'name'  => 'Mustakim',
                'email' => 'mustakim2@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340019781',
                'nip_panjang' => '197203082007011002',
                'jabatan_id' => '32'
            ],
            [
                'name'  => 'Catur Prihatin A.Md',
                'email' => 'catur.pri@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055418',
                'nip_panjang' => '198303092011011008',
                'jabatan_id' => '32'
            ],
            [
                'name'  => 'Abdul Muluk SE',
                'email' => 'abdul.muluk@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012577',
                'nip_panjang' => '196907271990031002',
                'jabatan_id' => '13'
            ],
            [
                'name'  => 'Asmawati S.Si',
                'email' => 'wathie@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340053881',
                'nip_panjang' => '198309052010032001',
                'jabatan_id' => '33'
            ],
            [
                'name'  => 'Sunu Fakhriadi S.Tr.Stat.',
                'email' => 'sunufahri@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058996',
                'nip_panjang' => '199704242019011001',
                'jabatan_id' => '33'
            ],




            //Produksi
            [
                'name'  => 'Irwanto S.Si, MM',
                'email' => 'irwanto@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013363',
                'nip_panjang' => '197012271992111001',
                'jabatan_id' => '5'
            ],
            [
                'name'  => 'A.A. Ngurah Gede Wasudewa SST',
                'email' => 'ngurah.wasudewa@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340056970',
                'nip_panjang' => '199202222014121001',
                'jabatan_id' => '17'
            ],
            [
                'name'  => 'Ariesa Setyaningrum SST',
                'email' => 'ariesa.setyaningrum@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340057299',
                'nip_panjang' => '199212202016022001',
                'jabatan_id' => '37'
            ],
            [
                'name'  => 'Eduin Jurnalis S.Sos',
                'email' => 'edwin@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013064',
                'nip_panjang' => '196908121992021001',
                'jabatan_id' => '18'
            ],
            [
                'name'  => 'Laksita Aga Damayanti SST',
                'email' => 'laksitaagad@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340057896',
                'nip_panjang' => '199309222017012001',
                'jabatan_id' => '38'
            ],
             [
                'name'  => 'Muhammad Zein SST',
                'email' => 'zein@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340019250',
                'nip_panjang' => '198301292007011001',
                'jabatan_id' => '19'
            ],
            //Sosial
             [
                'name'  => 'Mohamad Fadlian Syah SST, M.Si.',
                'email' => 'mfadli@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016272',
                'nip_panjang' => '197804052000121001',
                'jabatan_id' => '4'
            ],
            [
                'name'  => 'Sunu Hari Ismawan S.ST, M.Si',
                'email' => 'sunu@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016158',
                'nip_panjang' => '197703212000121001',
                'jabatan_id' => '14'
            ],
            [
                'name'  => 'I Made Widiguna SST',
                'email' => 'imade.widiguna@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340057893',
                'nip_panjang' => '199410082017011001',
                'jabatan_id' => '34'
            ],
             [
                'name'  => 'Gladius Alfonsus SST',
                'email' => 'alfon@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013816',
                'nip_panjang' => '197308251993121001',
                'jabatan_id' => '15'
            ],
            [
                'name'  => 'Farashintha Julhija Karim S.E.',
                'email' => 'farashinta@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340018371',
                'nip_panjang' => '198707272006042001',
                'jabatan_id' => '35'
            ],
            [
                'name'  => 'Zakia Nur Fadillah SST',
                'email' => 'zakia.fadillah@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340057286',
                'nip_panjang' => '199301242016022001',
                'jabatan_id' => '35'
            ],
            [
                'name'  => 'Yudhi Yogaswara SST',
                'email' => 'yogaz@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016533',
                'nip_panjang' => '198005072002121003',
                'jabatan_id' => '16'
            ],
            [
                'name'  => 'Yahdi Miftahuddin Kaenong S.Si',
                'email' => 'yahdimk@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340054410',
                'nip_panjang' => '197901252011011006',
                'jabatan_id' => '36'
            ],



            //Distribusi
            [
                'name'  => 'G.A. Nasser SE, MM',
                'email' => 'nasser@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340012909',
                'nip_panjang' => '196605051991031001',
                'jabatan_id' => '6'
            ],
             [
                'name'  => 'Indra Prasetyo Wibowo S.ST., M.P.W.P.',
                'email' => 'indrapw@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016531',
                'nip_panjang' => '198002222002121002',
                'jabatan_id' => '20'
            ],
            [
                'name'  => 'Nurhayati',
                'email' => 'yayan_nurhayati@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340018422',
                'nip_panjang' => '198503212006042002',
                'jabatan_id' => '40'
            ],
            [
                'name'  => 'Amriany Amir S.P, MP.',
                'email' => 'amriany.amir@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055413',
                'nip_panjang' => '197707132011012004',
                'jabatan_id' => '21'
            ],
             [
                'name'  => 'Henry Simanjuntak SST,M.Si',
                'email' => 'henryjuntak@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340015196',
                'nip_panjang' => '197003191995121001',
                'jabatan_id' => '41'
            ],
            [
                'name'  => 'Siswadi SST, M.Si.',
                'email' => 'siswadi@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340015770',
                'nip_panjang' => '197608051999011001',
                'jabatan_id' => '22'
            ],
            [
                'name'  => 'Muh Taufiqurrahman S.Tr.Stat.',
                'email' => 'muhtaufiq@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058844',
                'nip_panjang' => '199511272019011001',
                'jabatan_id' => '22'
            ],
            //Neraca
            [
                'name'  => 'Rukhedi S.Si. MSE',
                'email' => 'rukhedi@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340015178',
                'nip_panjang' => '197402261995121001',
                'jabatan_id' => '7'
            ],
            [
                'name'  => 'Agus Santoso SST, M.Si.',
                'email' => 'agus.santoso@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016233',
                'nip_panjang' => '197908182000121002',
                'jabatan_id' => '23'
            ],
             [
                'name'  => 'Maya Novita Sari S.Tr.Stat.',
                'email' => 'maya.novita@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058827',
                'nip_panjang' => '199510072019012002',
                'jabatan_id' => '43'
            ],
            [
                'name'  => 'Dra. Ni Nyoman Sri Suyasni Pura ',
                'email' => 'suyasni@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340013224',
                'nip_panjang' => '196709251992032008',
                'jabatan_id' => '24'
            ],
            [
                'name'  => 'Irwan Kurniawan SST',
                'email' => 'irwankn@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340016236',
                'nip_panjang' => '197603102000121001',
                'jabatan_id' => '25'
            ],
             [
                'name'  => 'Reny Anggraeni S.Si.',
                'email' => 'reny.anggraeni@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340059290',
                'nip_panjang' => '199304102019032001',
                'jabatan_id' => '45'
            ],
             [
                'name'  => 'Yudha Subakti S.Si.',
                'email' => 'yudha.subakti@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340059291',
                'nip_panjang' => '199106182019031001',
                'jabatan_id' => '45'
            ],
            //IPDS
             [
                'name'  => 'Ir. I Nyoman Dwinda M.Si',
                'email' => 'nyoman@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340014976',
                'nip_panjang' => '196410151994031001',
                'jabatan_id' => '8'
            ],
            [
                'name'  => 'Ananto Yanuar SST',
                'email' => 'a.yanuar@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340017862',
                'nip_panjang' => '198201182006021001',
                'jabatan_id' => '26'
            ],
             [
                'name'  => 'Bayu Setyawan SST',
                'email' => 'bayu.setyawan@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340056751',
                'nip_panjang' => '199106122014101001',
                'jabatan_id' => '46'
            ],
             [
                'name'  => 'Imam Satya Wedhatama S.Tr.Stat.',
                'email' => 'imam.satya@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058779',
                'nip_panjang' => '199609232019011001',
                'jabatan_id' => '46'
            ],
            [
                'name'  => 'Dedi Saputra SST, M.T',
                'email' => 'deputra@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340017865',
                'nip_panjang' => '198303252006021002',
                'jabatan_id' => '27'
            ],
            [
                'name'  => 'Hudi Javariawan S.Tr.Stat.',
                'email' => 'hudijavariawan@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340058768',
                'nip_panjang' => '199605202019011001',
                'jabatan_id' => '47'
            ],
            [
                'name'  => 'Bahtiar SST',
                'email' => 'tiarsidik@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340056227',
                'nip_panjang' => '198910262013111001',
                'jabatan_id' => '28'
            ],
            [
                'name'  => 'Sri Astuti S.Si',
                'email' => 'sri.astuti@bps.go.id',
                'password' => Hash::make('12341234'),
                'nip_pendek' => '340055436',
                'nip_panjang' => '198802022011012018',
                'jabatan_id' => '48'
            ],





            
            


          
        ]);
    }
}
