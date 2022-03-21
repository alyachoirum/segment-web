<?php
namespace App\Http\Controllers;

ini_set('date.timezone', 'Asia/Jakarta');
ini_set('intl.default_locale', 'id_ID');

use Illuminate\Http\Request;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\JadwalShift;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;


class TestGenerateSchedulShiftController extends Controller
{
    //
    public function index()
    {
        // pattern shift
        /*$pattern = ['S','S','OFF','M','M','OFF','P','P','P','S','S','OFF','M','M','M','OFF','P','P','S','S','OFF','OFF','M','M','OFF','P','P','S'];

        $regu_a = $pattern;
        $regu_b = array_merge(array_slice($pattern,21), array_slice($pattern,0,21));
        $regu_c = array_merge(array_slice($pattern,7), array_slice($pattern,0,7));
        $regu_d = array_merge(array_slice($pattern,14), array_slice($pattern,0,14));

        $en = CarbonImmutable::parse('2021-09-07')->locale('en_US');

        $tanggal = strtotime('2021-09-07');

        // number day of week
        $dow = $en->isoFormat('d'); //5

        $wom = $en->isoFormat('w'); //1

        if($wom > 4){
            if($wom % 4 == 0)
            $wom = 4;
            else
            $wom = $wom % 4;
        }

        $max_scope = $wom * 7;
        $min_scope = $max_scope - 7;

        $result['a'] = array_slice($regu_a,$min_scope, $max_scope)[$dow];
        $result['b'] = array_slice($regu_b,$min_scope, $max_scope)[$dow];
        $result['c'] = array_slice($regu_c,$min_scope, $max_scope)[$dow];
        $result['d'] = array_slice($regu_d,$min_scope, $max_scope)[$dow];

        $regu = ['A','B','C','D'];

        foreach($result as $value){
            $action[]=$value;
        }
        for($i = 0; $i < count($regu);$i++){
            $getregu = $regu[$i];
            $getaction = $action[$i];

            if($getaction  == 'OFF'){
                $masuk = 'LIBUR';
                $keluar = 'LIBUR';
            }elseif($getaction == 'P'){
                $masuk = '06.00';
                $keluar = '14.00';
            }elseif($getaction == 'S'){
                $masuk = '14.00';
                $keluar = '21.00';
            }elseif($getaction = 'M'){
                $masuk = '21.00';
                $keluar = '06.00';
            }

            $getdata []= array_merge([
                'regu' => $getregu,
                'action' => $getaction,
                'tanggal' => date('Y-m-d', $tanggal),
                'bulan' => date('F', $tanggal),
                'tahun' => date('Y', $tanggal),
                'pattern_number' => $wom,
                'jam_masuk' => $masuk,
                'jam_keluar' => $keluar
            ]);
        }
        return $getdata;*/

        //=============BATAS==============

        //2021
        // $pattern = ['S','S','OFF','M','M','OFF','P','P','P','S','S','OFF','M','M','M','OFF','P','P','S','S','OFF','OFF','M','M','OFF','P','P','S'];

        // $regu_a = $pattern;
        // $regu_b = array_merge(array_slice($pattern,21), array_slice($pattern,0,21));
        // $regu_c = array_merge(array_slice($pattern,7), array_slice($pattern,0,7));
        // $regu_d = array_merge(array_slice($pattern,14), array_slice($pattern,0,14));

        // $start = $day = strtotime('2021-01-01');
        // $end = strtotime('2021-12-31');
        // while($day <= $end)
        // {
        //     $date = date('Y-m-d', $day);

        //     $tgl = date('d',$day);
        //     $bln = date('m',$day);
        //     $thn = date('Y',$day);

        //     //doing inserting value
        //     $en = CarbonImmutable::parse($date)->locale('en_US');
        //     $dow = $en->isoFormat('d'); //5
        //     $wom = $en->isoFormat('w'); //1
        //     if($wom > 4){
        //         if($wom % 4 == 0)
        //         $wom = 4;
        //         else
        //         $wom = $wom % 4;
        //     }
        //     $max_scope = $wom * 7;
        //     $min_scope = $max_scope - 7;
        //     $result['1'] = array_slice($regu_a,$min_scope, $max_scope)[$dow];
        //     $result['2'] = array_slice($regu_b,$min_scope, $max_scope)[$dow];
        //     $result['3'] = array_slice($regu_c,$min_scope, $max_scope)[$dow];
        //     $result['4'] = array_slice($regu_d,$min_scope, $max_scope)[$dow];
        //     $day = strtotime("+1 day", $day);

        //     for($i='1';$i<='4';$i++){
        //         $shift_choose = $result[$i];

        //         if($shift_choose  == 'OFF'){
        //             $masuk = 'LIBUR';
        //             $keluar = 'LIBUR';
        //         }elseif($shift_choose == 'P'){
        //             $masuk = '06:00';
        //             $keluar = '14:00';
        //         }elseif($shift_choose == 'S'){
        //             $masuk = '14:00';
        //             $keluar = '21:00';
        //         }elseif($shift_choose = 'M'){
        //             $masuk = '21:00';
        //             $keluar = '06:00';
        //         }

        //         $data = [
        //             "tanggal"=>$tgl,
        //             "bulan"=>$bln,
        //             "tahun"=>$thn,
        //             "id_regu"=>$i,
        //             "pattern_number"=>"",
        //             "jam_masuk"=>$masuk,
        //             "jam_keluar"=>$keluar,
        //             "action"=>$shift_choose
        //         ];

        //         DB::table('jadwal_shifts')->insert($data);
        //     }
        // }

        //2022
        $pattern = ['S','S','OFF','M','M','OFF','P','P','P','S','S','OFF','M','M','M','OFF','P','P','S','S','OFF','OFF','M','M','OFF','P','P','S'];

        $regu_a = $pattern;
        $regu_b = array_merge(array_slice($pattern,21), array_slice($pattern,0,21));
        $regu_c = array_merge(array_slice($pattern,7), array_slice($pattern,0,7));
        $regu_d = array_merge(array_slice($pattern,14), array_slice($pattern,0,14));

        // dd($regu_a,$regu_b,$regu_c,$regu_d);
        $day = strtotime('2022-01-01');
        $end = strtotime('2022-12-31');
        while($day <= $end)
        {
            $date = date('Y-m-d', $day);

            $tgl = date('d',$day);
            $bln = date('m',$day);
            $thn = date('Y',$day);

            //doing inserting value
            $en = CarbonImmutable::parse($date)->locale('en_US');
            $dow = $en->isoFormat('d'); //6
            $wom = $en->isoFormat('w'); //1
            if($wom > 4){
                if($wom % 4 == 0)
                $wom = 4;
                else
                $wom = $wom % 4;
            }
            $max_scope = $wom * 7;
            $min_scope = $max_scope - 7;
            $result['1'] = array_slice($regu_a,$min_scope, $max_scope)[$dow];
            $result['2'] = array_slice($regu_b,$min_scope, $max_scope)[$dow];
            $result['3'] = array_slice($regu_c,$min_scope, $max_scope)[$dow];
            $result['4'] = array_slice($regu_d,$min_scope, $max_scope)[$dow];
            $day = strtotime("+1 day", $day);

            for($i='1';$i<='4';$i++){
                $shift_choose = $result[$i];

                if($shift_choose  == 'OFF'){
                    $masuk = 'LIBUR';
                    $keluar = 'LIBUR';
                }elseif($shift_choose == 'P'){
                    $masuk = '06:00';
                    $keluar = '14:00';
                }elseif($shift_choose == 'S'){
                    $masuk = '14:00';
                    $keluar = '21:00';
                }elseif($shift_choose = 'M'){
                    $masuk = '21:00';
                    $keluar = '06:00';
                }

                $data = [
                    "tanggal"=>$tgl,
                    "bulan"=>$bln,
                    "tahun"=>$thn,
                    "id_regu"=>$i,
                    "pattern_number"=>"",
                    "jam_masuk"=>$masuk,
                    "jam_keluar"=>$keluar,
                    "action"=>$shift_choose
                ];

                DB::table('jadwal_shifts')->insert($data);
            }
        }


        // JadwalShift::insert($data);


        // var_dump($result[$dow]);

        //$cal->setFirstDayOfWeek(\IntlCalendar::DOW_SUNDAY);
    }

    public function generate_cuti()
    {

        $total_karyawan = Karyawan::where('status_aktif',1)->get();

        while ($total_karyawan) {
            Karyawan::where('status_aktif',1)->update([
                    'sisa_cuti' => 12,
                ]);
        }

    }
}
