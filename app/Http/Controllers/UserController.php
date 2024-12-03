<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AuthUser;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = AuthUser::paginate(10);
        return view('pages.user.index', compact('users'));
    }
    public function oldindex()
    {


        // $data = Excel::load($path)->get();



            $inputFileName = 'sheet.xlsx';

/**  Identify the type of $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Create a new Reader of the type that has been identified  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);
die;

       

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Sheet 1'); // This is where you set the title 
        $sheet->setCellValue('A1', 'SNo'); // This is where you set the column header
        $sheet->setCellValue('B1', 'No'); // This is where you set the column header
        $sheet->setCellValue('C1', 'tmNo');// This is where you set the column header
        $sheet->setCellValue('D1', 'empNo');// This is where you set the column header
        $sheet->setCellValue('E1', 'Name');// This is where you set the column header
        $sheet->setCellValue('F1', 'gNo');// This is where you set the column header
        $sheet->setCellValue('G1', 'In/Out');// This is where you set the column header
        $sheet->setCellValue('H1', 'antiPass');// This is where you set the column header
        $sheet->setCellValue('I1', 'Proxy');// This is where you set the column header
        $sheet->setCellValue('J1', 'datetime');// This is where you set the column header

        $row = 2;// Initialize row counter

        $mainarray = array(); 
        foreach (file('attendance.txt') as $key => $item) { 
            // print_r($item);
            if($key > 0) {
                $item = explode("\t", $item);
                $date_time = $item[9] ?? '';

                $attendance_item = Attendance::create([
                    'no' => $item[0],
                    'tmno' => $item[1] ?? '', 
                    'empno' => $item[2] ?? '', 
                    'name' => $item[3] ?? '', 
                    'gmno' => $item[4] ?? '', 
                    'mode' => $item[5] ?? '', 
                    'in_out' => $item[6] ?? '', 
                    'anti_pass' => $item[7] ?? '', 
                    'proxy' => $item[8] ?? '', 
                    'date_time_string' => $item[9] ?? ''
                    // 'date_time' => $date_time ?? '',
                    // 'attendance_date' => !empty($date_time) ? $date_time : '',
                    // 'attendance_time' => !empty($date_time) ? $date_time : '',
    
                ]);

              $mainarray[] = array(
                    '0' => $item[0],
                    '1' => $item[1] ?? '', 
                    '2' => $item[2] ?? '', 
                    '3' => $item[3] ?? '', 
                    '4' => $item[4] ?? '', 
                    '5' => $item[5] ?? '', 
                    '6' => $item[6] ?? '', 
                    '7' => $item[7] ?? '', 
                    '8' => $item[8] ?? '', 
                    '9' => $date_time ?? '',
                    '10' => !empty($date_time) ? explode(" ",$date_time)[0] : '',
                    '11' => !empty($date_time) ? explode(" ",$date_time)[1] : '',
                ); 
                
                // $sheet->setCellValue('A' . $row, $attendance_item->id);
                // $sheet->setCellValue('b' . $row, $mainarray[0]);
                // $sheet->setCellValue('C' . $row, $mainarray[1]);
                // $sheet->setCellValue('D' . $row, $mainarray[2]);
                // $sheet->setCellValue('E' . $row, $mainarray[3]);
                // $sheet->setCellValue('F' . $row, $mainarray[4]);
                // $sheet->setCellValue('G' . $row, $mainarray[5]);
                // $sheet->setCellValue('H' . $row, $mainarray[6]);
                // $sheet->setCellValue('I' . $row, $mainarray[7]);
                // $sheet->setCellValue('J' . $row, $mainarray[8]);
                // $sheet->setCellValue('K' . $row, $mainarray[9]);
                // $sheet->setCellValue('L' . $row, $mainarray[10]);
                // $sheet->setCellValue('M' . $row, $mainarray[11]);
    
                // $row++;
            }
          
        } 



       

        // This is the loop to populate data

        // foreach($mainarray as $item) {
        //     $sheet->setCellValue('A' . $row, $item[0]);
        //     $sheet->setCellValue('B' . $row, $item[1]);
        //     $sheet->setCellValue('C' . $row, $item[2]);
        //     $sheet->setCellValue('D' . $row, $item[3]);
        //     $sheet->setCellValue('E' . $row, $item[4]);
        //     $sheet->setCellValue('F' . $row, $item[5]);
        //     $sheet->setCellValue('G' . $row, $item[6]);
        //     $sheet->setCellValue('H' . $row, $item[7]);
        //     $sheet->setCellValue('I' . $row, $item[8]);
        //     $sheet->setCellValue('J' . $row, $item[9]);
        //     $sheet->setCellValue('K' . $row, $item[10]);
        //     $sheet->setCellValue('L' . $row, $item[11]);


        //     $row++;
        // }

        for ($i=0; $i < count($mainarray); $i++) { 
            $sheet->setCellValue('A' . $row, $mainarray[$i][0]);
            $sheet->setCellValue('B' . $row, $mainarray[$i][1]);
            $sheet->setCellValue('C' . $row, $mainarray[$i][2]);
            $sheet->setCellValue('D' . $row, $mainarray[$i][3]);
            $sheet->setCellValue('E' . $row, $mainarray[$i][4]);
            $sheet->setCellValue('F' . $row, $mainarray[$i][5]);
            $sheet->setCellValue('G' . $row, $mainarray[$i][6]);
            $sheet->setCellValue('H' . $row, $mainarray[$i][7]);
            $sheet->setCellValue('I' . $row, $mainarray[$i][8]);
            $sheet->setCellValue('J' . $row, $mainarray[$i][9]);
            $sheet->setCellValue('K' . $row, $mainarray[$i][10]);
            $sheet->setCellValue('L' . $row, $mainarray[$i][11]);
            $row++;
        
        } 

       
        $writer = new Xlsx($spreadsheet);
        $fileName = "Your First Excel Exported From Laravel.xlsx";
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        $writer->save("php://output");
        exit();


        
        //  $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();

        // $sheet->setTitle('Sheet 1'); // This is where you set the title 
        // $sheet->setCellValue('A1', 'No'); // This is where you set the column header
        // $sheet->setCellValue('B1', 'Name');// This is where you set the column header
        // $row = 2;// Initialize row counter

        // // This is the loop to populate data
        // for ($i=1; $i < 5; $i++) { 
        //     $sheet->setCellValue('A' . $row, $i);
        //     $sheet->setCellValue('B' . $row, "People ".$i);
        //     $row++;
        
        // } 
        // $writer = new Xlsx($spreadsheet);
        // $fileName = "Your First Excel Exported From Laravel.xlsx";
        // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        // header("Content-Disposition: attachment;filename=\"$fileName\"");
        // $writer->save("php://output");
        // exit();


        // // return view('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}