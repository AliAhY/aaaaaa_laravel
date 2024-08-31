<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use PhpOffice\Phpexcel\IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportController extends Controller
{
    public function importform()
    {
        return view('import');
    }
    public function import(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Load the file
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        // Iterate over each row in the worksheet
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            // Skip the header row (assuming first row is a header)
            if ($rowIndex == 1) {
                continue;
            }

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = [];
            foreach ($cellIterator as $cellIndex => $cell) {
                $data[] = $cell->getValue();
            }

            $disability = $data[9] == 'لا' ? 0 : 1;
            $family_disability = $data[12] == 'لا' ? 0 : 1;
            $graduated = $data[27] == 'لا' ? 0 : 1;
            // $university_year = $data[28] == 'الأخيرة' ? 5 : 'الرابعة' ? 4 : 'الثالثة' ? 3 : 'الثانية' ? 2 : 1;
            if ($data[28] == 'الأخيرة') {
                $university_year = 5;
            } else if ($data[28] == 'الرابعة') {
                $university_year = 4;
            } else if ($data[28] == 'الثالثة') {
                $university_year = 3;
            } else if ($data[28] == 'الثانية') {
                $university_year = 2;
            } else $university_year = 1;
            $icdl = $data[29] == 'لا' ? 0 : 1;
            $beneficial_undp = $data[32] == 'لا' ? 0 : 1;
            $current_volunteer = $data[33] == 'لا' ? 0 : 1;
            $work_now = $data[36] == 'لا' ? 0 : 1;

            // Assuming the data array contains columns in this order: name, email, password
            Members::create([

                // 'name' => $data[0],
                // 'email' => $data[1],
                // 'password' => bcrypt($data[2]), // Encrypt the password
                'full_name' => $data[1],
                'father_name' => $data[2],
                'mother_name' => $data[3],
                'gender' => $data[4],
                'dob' => Carbon::createFromDate($data[5], 1, 1)->format('Y-m-d'),
                // 'dob' => $data[5],
                'lob' => $data[6],
                'marital_status' => $data[7],
                'family_member' => $data[8],
                'disability' => $disability,
                'disability_type' => $data[10],
                'disability_company' => $data[11],
                'family_disability' => $family_disability,
                'family_disability_type' => $data[13],
                'count_of_worker' => $data[14],
                'father_job' => $data[15],
                'mother_job' => $data[16],
                'military_status' => $data[17],
                'city' => $data[18],
                'address' => $data[19],
                'location_status' => $data[20],
                'phone1' => $data[21],
                'phone2' => $data[22],
                'national_id' => $data[23],
                'education_certificate' => $data[24],
                'education_field' => $data[25],
                'date_of_certificate' => $data[26],
                'graduated' => $graduated,
                'university_year' => $university_year,
                'icdl' => $icdl,
                'other_certificates' => $data[30],
                'previous_courses' => $data[31],
                'beneficial_undp' => $beneficial_undp,
                'current_volunteer' => $current_volunteer,
                'organization_name' => $data[34],
                'previous_experiences' => $data[35],
                'work_now' => $work_now,
                'current_job' => $data[37],
                'favorite_job' => $data[38],
                // 'course_chosen_id' => $data[39],
                'course_chosen_id' => 1,
                'fragility_father_job' => $data[40],
                'fragility_mother_job' => $data[41],
                'fragility_disability' => $data[42],
                'fragility_family_member' => $data[43],
                'fragility_family_worker' => $data[44],
                'fragility_military' => $data[45],
                'final_result' => $data[46],
                'description' => $data[47],
            ]);
        }

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
