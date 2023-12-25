<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Session;
use App;
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;

class RinggitServices
{


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/

    // ------------------- Akaun ------------------- //

    public function convertEjaan($number)
    {
        $tensNames = [
            "",
            " sepuluh",
            " dua puluh",
            " tiga puluh",
            " empat puluh",
            " lima puluh",
            " enam puluh",
            " tujuh puluh",
            " lapan puluh",
            " sembilan puluh"
        ];
    
            
    
        $numNames = [
            "",
            " satu",
            " dua",
            " tiga",
            " empat",
            " lima",
            " enam",
            " tujuh",
            " lapan",
            " sembilan",
            " sepuluh",
            " sebelas",
            " dua belas",
            " tiga belas",
            " empat belas",
            " lima belas",
            " enam belas",
            " tujuh belas",
            " lapan belas",
            " sembilan belas"
        ];
        
        // $number = 7654321;
        // dump(number_format((float)$number, 2, '.', ''));

        $two_decimal_price = number_format((float)$number, 2, '.', '');
        $clean_str_price = str_replace(",","",$two_decimal_price);
        $titik_perpuluhan_price = explode(".", $clean_str_price);
        // dd($titik_perpuluhan_price);
        $c_price_word = "";

        if (sizeof($titik_perpuluhan_price) > 1) {
            if ((int)$titik_perpuluhan_price[1] > 0) {
                $c_price_word = $this->convert($numNames,$tensNames,$titik_perpuluhan_price[0]) . " dan" . $this->convert($numNames,$tensNames,$titik_perpuluhan_price[1]) . "sen sahaja";
            } else {
                $c_price_word = $this->convert($numNames,$tensNames,$titik_perpuluhan_price[0]) . " sahaja";
            }
        } else {
            $c_price_word = $this->convert($numNames,$tensNames,$titik_perpuluhan_price[0]) . " sahaja";
        }

        // dd($c_price_word);
        
        return $c_price_word;
    
        
    }

    public function convertLessThanOneThousand($numNames,$tensNames,$value){
        $soFar = "";

        if($value > 99){
            $ind = 1;
        }else{
            $ind = 0;
        }
        
        if ($value % 100 < 20) {
            // dump("1 - ".$value);
          $soFar = $numNames[($value % 100)];
          $value /= 100;
        } else {
            // dump("2 - ".$value);
          $soFar = $numNames[($value % 10)];
          $value /= 10;

          $soFar = $tensNames[($value % 10)] ." ". $soFar;
          $value /= 10;
        }
        if ($value == 0) {
          return $soFar;
        }

        // dump($ind);
        // dump($value);
        if($ind == 1){
            return $numNames[$value] ." ratus " . $soFar;
        }else{
            return $numNames[$value] ."" . $soFar;
        }

    }
    
    public function convert($numNames,$tensNames,$number) {
        // 0 to 999 999 999 999
        if ($number == 0) {
            return "kosong";
        }

        // pad with "0"
        $mask = "%012d";
        $snumber = sprintf($mask, $number);

        // dump($snumber);
        
        // XXXnnnnnnnnn
        $billions = substr($snumber,0,3);
        // dump("b-".$billions);
        // nnnXXXnnnnnn
        $millions = substr($snumber,3,3);
        // dump("m-".$millions);
        // nnnnnnXXXnnn
        $hundredThousands = substr($snumber,6,3);
        // dump("h-".$hundredThousands);
        // nnnnnnnnnXXX
        $thousands = substr($snumber,9,3);
        // dump("t-".$thousands);

        $tradBillions = "";
        switch ($billions) {
            case 0:
                $tradBillions = "";
                break;
            default:
                $tradBillions = $this->convertLessThanOneThousand($numNames,$tensNames,$billions)
                        ."". " billion ";
        }
        $result = $tradBillions;

        $tradMillions = "";
        switch ($millions) {
            case 0:
                $tradMillions = "";
                break;
            default:
                $tradMillions = $this->convertLessThanOneThousand($numNames,$tensNames,$millions)
                        ."". " juta ";
        }
        $result = $result ."". $tradMillions;

        $tradHundredThousands = "";
        switch ($hundredThousands) {
            case 0:
                $tradHundredThousands = "";
                break;
            default:
                $tradHundredThousands = $this->convertLessThanOneThousand($numNames,$tensNames,$hundredThousands)
                        ."". " ribu ";
        }
        $result = $result ."". $tradHundredThousands;

        $tradThousand = "";
        $tradThousand = $this->convertLessThanOneThousand($numNames,$tensNames,$thousands);
        $result = $result ."". $tradThousand;
        
        $str_preg = preg_replace("/\s+/", " ",$result);

         return preg_replace("/\b\s{2,}\b/", " ",$str_preg);

        // return $result.preg_replace("\\s+", "").preg_replace("\\b\\s{2,}\\b", " ");

        // return $result;
    }

}
