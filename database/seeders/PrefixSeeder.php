<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prefix;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayPrefix =
        [   
            [
                'name' => 'AFG',
                'iso2'=> 'AF',
                'prefix' => '+93',
                'pais' => 'Afganistán'
            ],
            [
                'name' => 'ALB',
                'iso2'=> 'AL',
                'prefix' => '+355',
                'pais' => 'Albania'
            ],
            [
                'name' => 'DEU',
                'iso2'=> 'DE',
                'prefix' => '+49',
                'pais' => 'Alemania'
            ],
            [
                'name' => 'AND',
                'iso2'=> 'AD',
                'prefix' => '+376',
                'pais' => 'Andorra'
            ],
            [
                'name' => 'AGO',
                'iso2'=> 'AO',
                'prefix' => '+244',
                'pais' => 'Angola'
            ],
            [
                'name' => 'ATG',
                'iso2'=> 'AO',
                'prefix' => '+1268',
                'pais' => 'Antigua y Barbuda'
            ],
            [
                'name' => 'SAU',
                'iso2'=> 'SA',
                'prefix' => '+966',
                'pais' => 'Arabia Saudita'
            ],
            [
                'name' => 'DZA',
                'iso2'=> 'DZ',
                'prefix' => '+213',
                'pais' => 'Argelia'
            ],
            [
                'name' => 'ARG',
                'iso2'=> 'AG',
                'prefix' => '+54',
                'pais' => 'Argentina'
            ],
            [
                'name' => 'ARM',
                'iso2'=> 'AM',
                'prefix' => '+374',
                'pais' => 'Armenia'
            ],
            [
                'name' => 'AUS',
                'iso2'=> 'AU',
                'prefix' => '+61',
                'pais' => 'Australia'
            ],
            [
                'name' => 'AUT',
                'iso2'=> 'AT',
                'prefix' => '+43',
                'pais' => 'Austria'
            ],
            [
                'name' => 'AZE',
                'iso2'=> 'AZ',
                'prefix' => '+994',
                'pais' => 'Azerbaiyan'
            ],
            [
                'name' => 'BHS',
                'iso2'=> 'BS',
                'prefix' => '+1242',
                'pais' => 'Bahamas'
            ],
            [
                'name' => 'BGD',
                'iso2'=> 'BD',
                'prefix' => '+880',
                'pais' => 'Bangladesh'
            ],
            [
                'name' => 'BRB',
                'iso2'=> 'BB',
                'prefix' => '+1246',
                'pais' => 'Barbados'
            ],
            [
                'name' => 'BHR',
                'iso2'=> 'BH',
                'prefix' => '+973',
                'pais' => 'Barein'
            ],
            [
                'name' => 'BEL',
                'iso2'=> 'BE',
                'prefix' => '+32',
                'pais' => 'Bélgica'
            ],
            [
                'name' => 'BLZ',
                'iso2'=> 'BZ',
                'prefix' => '+501',
                'pais' => 'Belice'
            ],
            [
                'name' => 'BEN',
                'iso2'=> 'BJ',
                'prefix' => '+229',
                'pais' => 'Benin'
            ],
            [
                'name' => 'BLR',
                'iso2'=> 'BY',
                'prefix' => '+375',
                'pais' => 'Bielorrusia'
            ],
            [
                'name' => 'NLD',
                'iso2'=> 'NL',
                'prefix' => '+31',
                'pais' => 'Países Bajos'
            ],
            [
                'name' => 'BOL',
                'iso2'=> 'BO',
                'prefix' => '+591',
                'pais' => 'Bolivia'
            ],
            [
                'name' => 'BIH',
                'iso2'=> 'BA',
                'prefix' => '+387',
                'pais' => 'Bosnia y Herzegovina'
            ],
            [
                'name' => 'BWA',
                'iso2'=> 'BW',
                'prefix' => '+267',
                'pais' => 'Bosnia y Herzegovina'
            ],
            [
                'name' => 'BRA',
                'iso2'=> 'BR',
                'prefix' => '+55',
                'pais' => 'Brasil'
            ],
            [
                'name' => 'BRN',
                'iso2'=> 'BN',
                'prefix' => '+673',
                'pais' => 'Brunei'
            ],
            [
                'name' => 'BGR',
                'iso2'=> 'BG',
                'prefix' => '+359',
                'pais' => 'Bulgaria'
            ],
            [
                'name' => 'CPV',
                'iso2'=> 'CV',
                'prefix' => '+238',
                'pais' => 'Cabo Verde'
            ],
            [
                'name' => 'CMR',
                'iso2'=> 'CM',
                'prefix' => '+237',
                'pais' => 'Camerún'
            ],
            [
                'name' => 'CAN',
                'iso2'=> 'CA',
                'prefix' => '+1',
                'pais' => 'Canadá'
            ],
            [
                'name' => 'QAT',
                'iso2'=> 'QA',
                'prefix' => '+974',
                'pais' => 'Qatar'
            ], 
            [
                'name' => 'CHL',
                'iso2'=> 'CL',
                'prefix' => '+56' ,
                'pais' => 'Chile'
            ],
            [
                'name' => 'CHN',
                'iso2'=> 'CN',
                'prefix' => '+86',
                'pais' => 'Canadá'
            ],
            [
                'name' => 'CYP',
                'iso2'=> 'CY',
                'prefix' => '+86',
                'pais' => 'China'
            ],
            [
                'name' => 'VAT',
                'iso2'=> 'VA',
                'prefix' => '+39',
                'pais'  => 'Ciudad del Vaticano'
                
            ],
            [
                'name' => 'COL',
                'iso2'=> 'CO',
                'prefix' => '+57',
                'pais' => 'Colombia'
            ],
            [
                'name' => 'PRK',
                'iso2'=> 'KP',
                'prefix' => '+850',
                'pais' => 'Corea del Norte'
            ],
            [
                'name' => 'KOR',
                'iso2'=> 'KR',
                'prefix' => '+82',
                'pais' => 'Corea del Sur'
            ],
            [
                'name' => 'CIV',
                'iso2'=> 'CI',
                'prefix' => '+225',
                'pais' => 'Costa de Marfil'
            ],
            [
                'name' => 'CRI',
                'iso2'=> 'CR',
                'prefix' => '+506',
                'pais' => 'Costa Rica'
            ],
            [
                'name' => 'HRV',
                'iso2'=> 'HR',
                'prefix' => '+385',
                'pais' => 'Croacia'
            ],
            [
                'name' => 'CUB',
                'iso2'=> 'CU',
                'prefix' => '+53',
                'pais' => 'Cuba'
            ],
            [
                'name' => 'DNK',
                'iso2'=> 'DK',
                'prefix' => '+45',
                'pais' => 'Dinamarca'
            ],
            [
                'name' => 'DMA',
                'iso2'=> 'DM',
                'prefix' => '+1767',
                'pais' => 'Dominica'
            ],
            [
                'name' => 'ECU',
                'iso2'=> 'EC',
                'prefix' => '593',
                'pais' => 'Ecuador'
            ],
            [
                'name' => 'EGY',
                'iso2'=> 'EG',
                'prefix' => '+20',
                'pais' => 'Egipto'
            ],
            [
                'name' => 'SLV',
                'iso2'=> 'SV',
                'prefix' => '+503',
                'pais' => 'El Salvador'
            ],
            [
                'name' => 'ARE',
                'iso2'=> 'AE',
                'prefix' => '+971',
                'pais' => 'Emiratos Árabes Unidos'
            ],
            [
                'name' => 'SVK',
                'iso2'=> 'SK',
                'prefix' => '+421',
                'pais' => 'Eslovaquia'
            ],
            [
                'name' => 'SVN',
                'iso2'=> 'SI',
                'prefix' => '+386',
                'pais' => 'Eslovenia'
            ],
            [
                'name' => 'ESP',
                'iso2'=> 'ES',
                'prefix' =>'+34',
                'pais' => 'España'
            ],
            [
                'name' => 'USA',
                'iso2'=> 'US',
                'prefix' => '+1',
                'pais' => 'Estados Unidos de América'
            ],
            [
                'name' => 'EST',
                'iso2'=> 'EE',
                'prefix' => '+372',
                'pais' => 'Estonia'
            ],
            [
                'name' => 'PHL',
                'iso2'=> 'PH',
                'prefix' => '+63',
                'pais' => 'Filipinas'
            ],
            [
                'name' => 'FIN',
                'iso2'=> 'FI',
                'prefix' => '+358',
                'pais' => 'Finlandia'
            ],
            [
                'name' => 'FRA',
                'iso2'=> 'FR',
                'prefix' => '+33',
                'pais' => 'Francia'
            ],
            [
                'name' => 'GHA',
                'iso2'=> 'GH',
                'prefix' => '+233',
                'pais' => 'Ghana'
            ],
            [
                'name' => 'GRC',
                'iso2'=> 'GR',
                'prefix' => '+30',
                'pais' => 'Grecia'
            ],
            [
                'name' => 'GTM',
                'iso2'=> 'GT',
                'prefix' => '+502',
                'pais' => 'Guatemala'
            ],
            [
                'name' => 'HTI',
                'iso2'=> 'HT',
                'prefix' => '+509',
                'pais' => 'Haití'
            ],
            [
                'name' => 'HND',
                'iso2'=> 'HN',
                'prefix' => '+504',
                'pais'  => 'Honduras'
            ],
            [
                'name' => 'HUN',
                'iso2'=> 'HU',
                'prefix' => '+36',
                'pais'  => 'Hungría'
            ],
            [
                'name' => 'IND',
                'iso2'=> 'IN',
                'prefix' => '+91',
                'pais'  => 'India'
            ],
            [
                'name' => 'IDN',
                'iso2'=> 'ID',
                'prefix' => '+62',
                'pais'  => 'Indonesia'
            ],
            [
                'name' => 'IRQ',
                'iso2'=> 'IQ',
                'prefix' => '+964',
                'pais'  => 'Irak'
            ],
            [
                'name' => 'IRN',
                'iso2'=> 'IR',
                'prefix' => '+98',
                'pais'  => 'Irán'
            ],
            [
                'name' => 'IRL',
                'iso2'=> 'IE',
                'prefix' => '+353',
                'pais'  => 'Irlanda'
            ],
            [
                'name' => 'ISL',
                'iso2'=> 'IS',
                'prefix' => '+354',
                'pais'  => 'Islandia'
            ],
            [
                'name' => 'MHL',
                'iso2'=> 'MH',
                'prefix' => '+692',
                'pais'  => 'Islas Marshall'
            ],
            [
                'name' => 'SLB',
                'iso2'=> 'SB',
                'prefix' => '+677',
                'pais'  => 'Islas Salomón'
            ],
            [
                'name' => 'ISR',
                'iso2'=> 'IL',
                'prefix' => '+972',
                'pais'  => 'Israel'
            ],
            [
                'name' => 'ITA',
                'iso2'=> 'IT',
                'prefix' => '+39',
                'pais'  => 'Italia'
            ],
            [
                'name' => 'JAM',
                'iso2'=> 'JM',
                'prefix' => '+1876',
                'pais'  => 'Jamaica'
            ],
            [
                'name' => 'JPN',
                'iso2'=> 'JP',
                'prefix' => '+81'  ,
                'pais'  => 'Japón'
            ],
           
            [
                'name' => 'KAZ',
                'iso2'=> 'KZ',
                'prefix' => '+7',
                'pais'  => 'Kazajistán'
            ],
            [
                'name' => 'LVA',
                'iso2'=> 'LV',
                'prefix' => '+371',
                'pais'  => 'Letonia'
            ],
            [
                'name' => 'LBN',
                'iso2'=> 'LB',
                'prefix' => '+961',
                'pais'  => 'Líbano'
            ],
            [
                'name' => 'LBR',
                'iso2'=> 'LR',
                'prefix' => '+231',
                'pais'  => 'Liberia'
            ],
            [
                'name' => 'LBY',
                'iso2'=> 'LY',
                'prefix' => '+218',
                'pais'  => 'Libia'
            ],
            [
                'name' => 'LIE',
                'iso2'=> 'LI',
                'prefix' => '+423',
                'pais'  => 'Liechtenstein'
            ],
            [
                'name' => 'LTU',
                'iso2'=> 'LT',
                'prefix' => '+370',
                'pais'  => 'Lituania'
            ],
            [
                'name' => 'LUX',
                'iso2'=> 'LU',
                'prefix' => '+352',
                'pais'  => 'Luxemburgo'
            ],
            [
                'name' => 'MYS',
                'iso2'=> 'MY',
                'prefix' => '+60',
                'pais'  => 'Malasia'
            ],
            [
                'name' => 'MDV',
                'iso2'=> 'MV',
                'prefix' => '+960',
                'pais'  => 'Islas Maldivas'
            ],
            [
                'name' => 'MLI',
                'iso2'=> 'ML',
                'prefix' => '+223',
                'pais'  => 'Mali'
            ],
            [
                'name' => 'MLT',
                'iso2'=> 'MT',
                'prefix' => '+356',
                'pais'  => 'Malta'
            ],
            [
                'name' => 'MAR',
                'iso2'=> 'MA',
                'prefix' => '+212',
                'pais'  => 'Marruecos'
            ],
            [
                'name' => 'MUS',
                'iso2'=> 'MU',
                'prefix' => '+230',
                'pais'  => 'Mauricio'
            ],
            [
                'name' => 'MRT',
                'iso2'=> 'MR',
                'prefix' => '+222',
                'pais'  => 'Mauritania'
            ],
            [
                'name' => 'MEX',
                'iso2'=> 'MX',
                'prefix' => '+52',
                'pais'  => 'México'
            ],
            [
                'name' => 'FSM',
                'iso2'=> 'FM',
                'prefix' => '+691',
                'pais'  => 'Micronesia'
            ],
            [
                'name' => 'MDA',
                'iso2'=> 'MD',
                'prefix' => '+373',
                'pais'  => 'Moldavia'
            ],
            [
                'name' => 'MCO',
                'iso2'=> 'MC',
                'prefix' => '+377',
                'pais'  => 'Mónaco'
            ],
            [
                'name' => 'MNG',
                'iso2'=> 'MN',
                'prefix' => '+976',
                'pais'  => 'Mongolia'
            ],
            [
                'name' => 'MNE',
                'iso2'=> 'ME',
                'prefix' => '+382',
                'pais'  => 'Montenegro'
            ],
            [
                'name' => 'MOZ',
                'iso2'=> 'MZ',
                'prefix' => '+258',
                'pais'  => 'Mozambique'
            ],
            [
                'name' => 'NAM',
                'iso2'=> 'NA',
                'prefix' => '+264',
                'pais'  => 'Namibia'
            ],
            [
                'name' => 'NRU',
                'iso2'=> 'NR',
                'prefix' => '+674',
                'pais'  => 'Nauru'
            ],
            [
                'name' => 'NPL',
                'iso2'=> 'NP',
                'prefix' => '+977',
                'pais'  => 'Nepal'
            ],
            [
                'name' => 'NIC',
                'iso2'=> 'NI',
                'prefix' => '+505',
                'pais'  => 'Nicaragua'
            ],
            [
                'name' => 'NER',
                'iso2'=> 'NE',
                'prefix' => '+227',
                'pais'  => 'Niger'
            ],
            [
                'name' => 'NGA',
                'iso2'=> 'NG',
                'prefix' => '+234',
                'pais'  => 'Nigeria'
            ],
            [
                'name' => 'NOR',
                'iso2'=> 'NO',
                'prefix' => '+47',
                'pais'  => 'Noruega'
            ],
            [
                'name' => 'NZL',
                'iso2'=> 'NZ',
                'prefix' => '+64',
                'pais'  => 'Nueva Zelanda'
            ],
            [
                'name' => 'OMN',
                'iso2'=> 'OM',
                'prefix' => '+968',
                'pais'  => 'Omán'
            ],
            [
                'name' => 'NLD',
                'iso2'=> 'NL',
                'prefix' => '+31',
                'pais'  => 'Países Bajos'
            ],
            [
                'name' => 'PAK',
                'iso2'=> 'PK',
                'prefix' => '+92',
                'pais'  => 'Pakistán'
            ],
            [
                'name' => 'PLW',
                'iso2'=> 'PW',
                'prefix' => '+680',
                'pais'  => 'Palau'
            ],
            [
                'name' => 'PSE',
                'iso2'=> 'PS',
                'prefix' => '+970',
                'pais'  => 'Palestina'
            ],
            [
                'name' => 'PAN',
                'iso2'=> 'PA',
                'prefix' => '+507',
                'pais'  => 'Panamá'
            ],
            [
                'name' => 'PNG',
                'iso2'=> 'PG',
                'prefix' => '+675',
                'pais'  => 'Papúa Nueva Guinea'
            ],
            [
                'name' => 'PRY',
                'iso2'=> 'PY',
                'prefix' => '+595',
                'pais'  => 'Paraguay'
            ],
            [
                'name' => 'PER',
                'iso2'=> 'PE',
                'prefix' => '+51',
                'pais'  => 'Perú'
            ],
            [
                'name' => 'POL',
                'iso2'=> 'PL',
                'prefix' => '+48',
                'pais'  => 'Polonia'
            ],
            [
                'name' => 'PRT',
                'iso2'=> 'PT',
                'prefix' => '+351',
                'pais'  => 'Portugal'
            ],
            [
                'name' => 'GBR',
                'iso2'=> 'GB',
                'prefix' => '+44',
                'pais'  => 'Reino Unido'
            ],
            [
                'name' => 'CAF',
                'iso2'=> 'CF',
                'prefix' => '+236',
                'pais'  => 'República Centroafricana'
            ],
            [
                'name' => 'CZE',
                'iso2'=> 'CZ',
                'prefix' => '+420',
                'pais'  => 'República Checa'
            ],
            [
                'name' => 'COG',
                'iso2'=> 'CG',
                'prefix' => '+242',
                'pais'  => 'República del Congo'
            ],
            [
                'name' => 'COD',
                'iso2'=> 'CD',
                'prefix' => '+243',
                'pais'  => 'República Democrática del Congo'
            ],
            [
                'name' => 'DOM',
                'iso2'=> 'DO',
                'prefix' => '+1767',
                'pais'  => 'Dominica'
            ],
            [
                'name' => 'REU',
                'iso2'=> 'RE',
                'prefix' => '+262',
                'pais'  => 'Reunión'
            ],
            [
                'name' => 'RWA',
                'iso2'=> 'RW',
                'prefix' => '+250',
                'pais'  => 'Ruanda'
            ],
            [
                'name' => 'ROU',
                'iso2'=> 'RO',
                'prefix' => '+40',
                'pais'  => 'Rumanía'
            ],
            [
                'name' => 'RUS',
                'iso2'=> 'RU',
                'prefix' => '+7',
                'pais'  => 'Rusia'
            ],
            [
                'name' => 'WSM',
                'iso2'=> 'WS',
                'prefix' => '+685',
                'pais'  => 'Samoa'
            ],
            [
                'name' => 'KNA',
                'iso2'=> 'KN',
                'prefix' => '+1869',
                'pais'  => 'San Cristóbal y Nieves'
            ],
            [
                'name' => 'SMR',
                'iso2'=> 'SM',
                'prefix' => '+378',
                'pais'  => 'San Marino'
            ],
            [
                'name' => 'VCT',
                'iso2'=> 'VC',
                'prefix' => '+1',
                'pais'  => 'Paraguay'
            ],
            [
                'name' => 'LCA',
                'iso2'=> 'LC',
                'prefix' => '+1784',
                'pais'  => 'San Vicente y las Granadinas'
            ],
            [
                'name' => 'STP',
                'iso2'=> 'ST',
                'prefix' => '+239',
                'pais'  => 'Santo Tomé y Príncipe'
            ],
            [
                'name' => 'SEN',
                'iso2'=> 'SN',
                'prefix' => '+221',
                'pais'  => 'Senegal'
            ],
            [
                'name' => 'SRB',
                'iso2'=> 'RS',
                'prefix' => '+381',
                'pais'  => 'Serbia'
            ],
            [
                'name' => 'SYC',
                'iso2'=> 'SC',
                'prefix' => '+248',
                'pais'  => 'Seychelles'
            ],
            [
                'name' => 'SLE',
                'iso2'=> 'SL',
                'prefix' => '+232',
                'pais'  => 'Sierra Leona'
            ],
            [
                'name' => 'SGP',
                'iso2'=> 'SG',
                'prefix' => '+65',
                'pais'  => 'Singapur'
            ],
            [
                'name' => 'SYR',
                'iso2'=> 'SY',
                'prefix' => '+963',
                'pais'  => 'Siria'
            ],
            [
                'name' => 'SOM',
                'iso2'=> 'SO',
                'prefix' => '+252',
                'pais'  => 'Somalia'
            ],
            [
                'name' => 'LKA',
                'iso2'=> 'LK',
                'prefix' => '+94',
                'pais'  => 'Sri lanka'
            ],
            [
                'name' => 'SWZ',
                'iso2'=> 'SZ',
                'prefix' => '+268',
                'pais'  => 'Swazilandia'
            ],
            [
                'name' => 'SDN',
                'iso2'=> 'SD',
                'prefix' => '+249',
                'pais'  => 'Sudán'
            ],
            [
                'name' => 'SSD',
                'iso2'=> 'SS',
                'prefix' => '+211',
                'pais'  => 'República de Sudán del Sur'
            ],
            [
                'name' => 'SWE',
                'iso2'=> 'SE',
                'prefix' => '+46',
                'pais'  => 'Suecia'
            ],
            [
                'name' => 'CHE',
                'iso2'=> 'CH',
                'prefix' => '+41',
                'pais'  => 'Suiza'
            ],
            [
                'name' => 'SUR',
                'iso2'=> 'SR',
                'prefix' => '+597',
                'pais'  => 'Surinám'
            ],
            [
                'name' => 'THA',
                'iso2'=> 'TZ',
                'prefix' => '+66',
                'pais'  => 'Tailandia'
            ],
            [
                'name' => 'TZA',
                'iso2'=> 'TZ',
                'prefix' => '+255',
                'pais'  => 'Tanzania'
            ],
            [
                'name' => 'TJK',
                'iso2'=> 'TJ',
                'prefix' => '+992',
                'pais'  => 'Tayikistán'
            ],
            [
                'name' => 'TLS',
                'iso2'=> 'TL',
                'prefix' => '+670',
                'pais'  => 'Timor Oriental'
            ],
            [
                'name' => 'TGO',
                'iso2'=> 'TG',
                'prefix' => '+228',
                'pais'  => 'Togo'
            ],
            [
                'name' => 'TON',
                'iso2'=> 'TO',
                'prefix' => '+676',
                'pais'  => 'Tonga'
            ],
            [
                'name' => 'TTO',
                'iso2'=> 'TT',
                'prefix' => '+1868',
                'pais'  => 'Trinidad y Tobago'
            ],
            [
                'name' => 'TUN',
                'iso2'=> 'TN',
                'prefix' => '+216',
                'pais'  => 'Tunez'
            ],
            [
                'name' => 'TKM',
                'iso2'=> 'TM',
                'prefix' => '+993',
                'pais'  => 'Turkmenistán'
            ],
            [
                'name' => 'TUR',
                'iso2'=> 'TR',
                'prefix' => '+90',
                'pais'  => 'Turquía'
            ],
            [
                'name' => 'TUV',
                'iso2'=> 'TV',
                'prefix' => '+688',
                'pais'  => 'Tuvalu'
            ],
            [
                'name' => 'UKR',
                'iso2'=> 'UA',
                'prefix' => '+380',
                'pais'  => 'Ucrania'
            ],
            [
                'name' => 'UGA',
                'iso2'=> 'UG',
                'prefix' => '+256',
                'pais'  => 'Uganda'
            ],
            [
                'name' => 'URY',
                'iso2'=> 'UY',
                'prefix' => '+598',
                'pais'  => 'Uruguay'
            ],
            [
                'name' => 'VEN',
                'iso2'=> 'VE',
                'prefix' => '+58',
                'pais'  => 'Venezuela'
            ]
        ];

        foreach ($arrayPrefix as $prefix ) {
            Prefix::create($prefix);
        }
    }
}

