<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
           
            ['bank_id'=>'ABB0234' ,'bank_name'=>'Affin Bank Berhad B2C - Test ID','display_name'=>'Affin B2C - Test ID','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'ABB0233' ,'bank_name'=>'Affin Bank Berhad ','display_name'=>'Affin Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'ABMB0212' ,'bank_name'=>'Alliance Bank Malaysia Berhad','display_name'=>'Alliance Bank (Personal)','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'AGRO01' ,'bank_name'=>'BANK PERTANIAN MALAYSIA BERHAD (AGROBANK)','display_name'=>'AGRONet','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'AMBB0209' ,'bank_name'=>'AmBank Malaysia Berhad','display_name'=>'AmBank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BIMB0340' ,'bank_name'=>'Bank Islam Malaysia Berhad','display_name'=>'Bank Islam','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BMMB0341' ,'bank_name'=>'Bank Muamalat Malaysia Berhad','display_name'=>'Bank Muamalat','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BKRM0602' ,'bank_name'=>'Bank Kerjasama Rakyat Malaysia Berhad','display_name'=>'Bank Rakyat','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BOCM01' ,'bank_name'=>'Bank Of China (M) Berhad','display_name'=>'Bank Of China','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BSN0601' ,'bank_name'=>'Bank Simpanan Nasional','display_name'=>'BSN','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'BCBB0235' ,'bank_name'=>'CIMB Bank Berhad','display_name'=>'CIMB Clicks','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'CIT0219' ,'bank_name'=>'CITI Bank Berhad','display_name'=>'Citibank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'HLB0224' ,'bank_name'=>'Hong Leong Bank Berhad','display_name'=>'Hong Leong Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'HSBC0223' ,'bank_name'=>'HSBC Bank Malaysia Berhad','display_name'=>'HSBC Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'KFH0346' ,'bank_name'=>'Kuwait Finance House (Malaysia) Berhad','display_name'=>'KFH','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'MBB0228' ,'bank_name'=>'Malayan Banking Berhad (M2E)','display_name'=>'Maybank2E','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'MB2U0227' ,'bank_name'=>'Malayan Banking Berhad (M2U)','display_name'=>'Maybank2U','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'OCBC0229' ,'bank_name'=>'OCBC Bank Malaysia Berhad','display_name'=>'OCBC Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'PBB0233' ,'bank_name'=>'Public Bank Berhad','display_name'=>'Public Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'RHB0218' ,'bank_name'=>'RHB Bank Berhad','display_name'=>'RHB Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'TEST0021' ,'bank_name'=>'SBI Bank A','display_name'=>'SBI Bank A','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'TEST0022' ,'bank_name'=>'SBI Bank B','display_name'=>'SBI Bank B','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'TEST0023' ,'bank_name'=>'SBI Bank C','display_name'=>'SBI Bank C','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'SCB0216' ,'bank_name'=>'Standard Chartered Bank','display_name'=>'Standard Chartered Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'UOB0226' ,'bank_name'=>'United Overseas Bank','display_name'=>'United Overseas Bank','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['bank_id'=>'UOB0229' ,'bank_name'=>'United Overseas Bank - B2C Test','display_name'=>'UOB Bank - Test ID','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
           
        ];

        DB::table('bank')->insert($banks);

    }
}
