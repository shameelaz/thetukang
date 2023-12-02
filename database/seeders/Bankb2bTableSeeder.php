<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Bankb2bTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $banks = [

        ['bank_id'=>'ABB0232' ,'bank_name'=>'Affin Bank Berhad','display_name'=>'Affin Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'ABB0235' ,'bank_name'=>'Affin Bank Berhad B2B','display_name'=>'AFFINMAX','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'ABMB0213' ,'bank_name'=>'Alliance Bank Malaysia Berhad','display_name'=>'Alliance Bank Malaysia Berhad','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'AGRO02' ,'bank_name'=>'BANK PERTANIAN MALAYSIA BERHAD (AGROBANK)','display_name'=>'AGRONetBIZ','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'AMBB0208' ,'bank_name'=>'AmBank Malaysia Berhad','display_name'=>'AmBank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'BIMB0340' ,'bank_name'=>'Bank Islam Malaysia Berhad','display_name'=>'Bank Islam','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'BMMB0342' ,'bank_name'=>'Bank Muamalat Malaysia Berhad','display_name'=>'Bank Muamalat','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'BNP003' ,'bank_name'=>'BNP Paribas Malaysia Berhad','display_name'=>'BNP Paribas','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'BCBB0235' ,'bank_name'=>'CIMB Bank Berhad','display_name'=>'CIMB Bank Berhad','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'CIT0218' ,'bank_name'=>'CITI Bank Berhad','display_name'=>'Citibank Corporate Banking','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'DBB0199' ,'bank_name'=>'Deutsche Bank Berhad','display_name'=>'Deutsche Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'HLB0224' ,'bank_name'=>'Hong Leong Bank Berhad','display_name'=>'Hong Leong Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'HSBC0223' ,'bank_name'=>'HSBC Bank Malaysia Berhad','display_name'=>'HSBC Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'BKRM0602' ,'bank_name'=>'Bank Kerjasama Rakyat Malaysia Berhad','display_name'=>'i-bizRAKYAT','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'KFH0346' ,'bank_name'=>'Kuwait Finance House (Malaysia) Berhad','display_name'=>'KFH','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'MBB0228' ,'bank_name'=>'Malayan Banking Berhad (M2E)','display_name'=>'Maybank2E','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'OCBC0229' ,'bank_name'=>'MOCBC Bank Malaysia Berhad','display_name'=>'OCBC Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'PBB0233' ,'bank_name'=>'Public Bank Berhad','display_name'=>'Public Bank PBe','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'PBB0234' ,'bank_name'=>'Public Bank Enterprise','display_name'=>'Public Bank PB enterprise','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ['bank_id'=>'RHB0218' ,'bank_name'=>'RHB Bank Berhad','display_name'=>'RHB Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
         ['bank_id'=>'TEST0021' ,'bank_name'=>'SBI Bank A','display_name'=>'SBI Bank A','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
         ['bank_id'=>'TEST0022' ,'bank_name'=>'SBI Bank B','display_name'=>'SBI Bank B','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
         ['bank_id'=>'TEST0023' ,'bank_name'=>'SBI Bank C','display_name'=>'SBI Bank C','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
          ['bank_id'=>'SCB0215' ,'bank_name'=>'Standard Chartered Bank','display_name'=>'Standard Chartered','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
          ['bank_id'=>'UOB0228' ,'bank_name'=>'United Overseas Bank B2B Regional','display_name'=>'UOB Regional','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],


           ];

        DB::table('bank_b2b')->insert($banks);
    }
}
