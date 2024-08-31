<?php

namespace App\Http\Controllers;

use App\Http\Requests\addAudienceRequest;
use App\Http\Requests\addSessionRequest;
use App\Http\Requests\CoursesTableStoreRequest;
use App\Models\Cources;
use App\Models\CouresDays;
use App\Models\CourseMembers;
use App\Models\Courses;
use App\Models\CoursesDays;
use App\Models\CoursesMembers;
use App\Models\DaysMembers;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcourses = Courses::all();
        return view('CoursesTable.index', compact('allcourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CoursesTable.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursesTableStoreRequest $request)
    {
        Courses::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_hours' => $request->number_of_hours,
            'status' => $request->status,
            'content' => $request->content,
            'num_of_sess' => $request->num_of_sess,
        ]);
        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $courses = Courses::findOrFail($id);
        return view('CoursesTable.edit', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(CoursesTableStoreRequest $request, string $id)
    {
        $check = Courses::find($id);
        $check->name = $request->name;
        $check->start_date = $request->start_date;
        $check->end_date = $request->end_date;
        $check->number_of_hours = $request->number_of_hours;
        $check->status = $request->status;
        $check->num_of_sess = $request->num_of_sess;
        $check->content = $request->content;


        $totalHours = CouresDays::where('cousre_id', $id)->sum('number_of_hours');
        $num_of_hours_remaining = (int)$check->number_of_hours - $totalHours;
        
        if ($num_of_hours_remaining == 0) {
            $check->status = "مكتمل";
            $check->save();
        } else {
            $check->status = "قيد التنفيذ";
            $check->save();
        }
        // $check->save();
        return  redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // البحث عن الدورة باستخدام المعرف  
        $course = Courses::find($id);
        $course->delete();
        // استرجاع الجلسات المرتبطة بالدورة  
        $course_days = CouresDays::where('cousre_id', $id)->get();

        foreach ($course_days as $course_day) {
            $course_day->delete();
        }

        $day_members = DaysMembers::where('course_id', $id)->get();
        foreach ($day_members as $day_member) {
            $day_member->delete();
        }

        $course_members = CourseMembers::where('course_id', $id)->get();
        foreach ($course_members as $course_member) {
            $course_member->delete();
        }

        return redirect('/courses')->with('success', 'تم حذف الدورة وكل ما يتعلق بها بنجاح.');
    }

    public function members($id)
    {
        $members = Members::get();
        $data = CourseMembers::with('member')->where('course_id', $id)->get();
        $course = Courses::findOrFail($id);
        // return $course;
        return view('CoursesTable.members.index', compact('data', 'members', 'id', 'course'));
    }

    public function add_member(Request $request, $id)
    {
        // التحقق من وجود العضو في الكورس
        $exists = CourseMembers::where('course_id', $id)
            ->where('member_id', $request->member_id)
            ->exists();

        if ($exists) {
            // إعادة التوجيه مع رسالة خطأ
            return back()->with('error', 'العضو موجود بالفعل في هذا الكورس.');
        }

        // إضافة العضو إذا لم يكن موجودًا
        CourseMembers::create([
            'course_id' => $id,
            'member_id' => $request->member_id
        ]);

        return back()->with('success', 'تم إضافة العضو بنجاح.');
    }

    public function delete_member($id)
    {
        // dd($id);
        $courseMember = CourseMembers::find($id);
        if ($courseMember) {
            $courseMember->delete();
        }
        return back();
    }


    // ---------------------------------------------

    public function sessions($id)
    {
        $days = CouresDays::where('cousre_id', $id)->get();
        $count_of_session = CouresDays::where('cousre_id', $id)->count();
        $totalHours = CouresDays::where('cousre_id', $id)->sum('number_of_hours');
        $course = Courses::findOrFail($id);
        $num_of_hours_remaining = (int)$course->number_of_hours - $totalHours;

        $check_attendece = DaysMembers::where('course_id', $id)->get();
        // return $check_attendece;

        $percentage_completion = 0; // القيمة الافتراضية في حالة كون $course->number_of_hours = 0  
        if ($course->number_of_hours > 0) {
            $percentage_completion = (int)(($totalHours / $course->number_of_hours) * 100);
        }


        $date_sess_from = CouresDays::where('cousre_id', $id)->first();

        // ==============================

        $days = CouresDays::where('cousre_id', $id)->get();
        // return $days;
        $course = Courses::findOrFail($id);

        $attendanceMessages = []; // مصفوفة لتخزين رسائل الحضور لكل يوم  

        foreach ($days as $day) {
            $attendanceRecords = DaysMembers::where('day_id', $day->id)
                ->where('course_id', $id)
                ->get();
            // return $attendanceRecords;
            // تحقق مما إذا كانت هناك أي سجلات حضور  
            $attendanceMessage = '';
            if ($attendanceRecords) {
                // تحقق مما إذا كانت أي حالة غير فارغة  
                $hasAttendance = $attendanceRecords->contains(function ($record) {
                    return !empty($record->status);
                });

                if (!$hasAttendance) {
                    $attendanceMessage = 'لم يتم اضافة تفقد .';
                }
            }

            $attendanceMessages[$day->id] = $attendanceMessage; // تخزين الرسالة في المصفوفة  
        }

        // ==============================

        return view('CoursesTable.sessions.sessions', compact('days', 'id', 'course', 'count_of_session', 'totalHours', 'num_of_hours_remaining', 'percentage_completion', 'date_sess_from', 'attendanceMessages'));
    }

    public function add_session(addSessionRequest $request, $id)
    {
        $course = Courses::findOrFail($id);

        // التحقق مما إذا كان تاريخ الجلسة أقل من تاريخ بداية الكورس  
        if ($request->date_of_day < $course->start_date) {
            return back()->withErrors(['date_of_day' => 'يجب أن يكون تاريخ الجلسة أكبر من أو يساوي تاريخ بداية الكورس.']);
        }

        // إذا مر التحقق، قم بإنشاء جلسة جديدة  
        CouresDays::create([
            'date_of_day' => $request->date_of_day,
            'number_of_hours' => $request->number_of_hours,
            'cousre_id' => $id,
        ]);

        // =====================
        // اذا تم اضافة جلسة الى الكورس يتم تحويل حالة الكورس الى قيد التنفيذ 
        $update_course_statuse = Courses::findOrFail($id);
        $update_course_statuse->status = "قيد التنفيذ";
        $update_course_statuse->save();

        // =====================
        // اذااصبح عدد الساعات المتبقي يساوي صفر يتم تحويل حالة الكورس الى مكتمل 
        $totalHours = CouresDays::where('cousre_id', $id)->sum('number_of_hours');
        $course = Courses::findOrFail($id);
        $num_of_hours_remaining = (int)$course->number_of_hours - $totalHours;
        if ($num_of_hours_remaining == 0) {
            $update_course_statuse->status = "مكتمل";
            $update_course_statuse->save();
        } else {
            $update_course_statuse->status = "قيد التنفيذ";
            $update_course_statuse->save();
        }


        return back()->with('success', 'تم إضافة الجلسة بنجاح.');
    }


    public function delete_session($id)
    {
        $course = CouresDays::find($id);
        if ($course) {
            $course->delete();
        }
        $members = DaysMembers::where('day_id', $id)->get();

        foreach ($members as $member) {
            $member->delete();
        }
        return back();
    }

    public function showAudience($courseId, $dayId)
    {
        $courseMembers = CourseMembers::where('course_id', $courseId)
            ->with('member')
            ->get();
        $daysMembers = DaysMembers::with('member')->where('day_id', $dayId)->get();
        return view('CoursesTable.sessions.audience.audiences', compact('courseMembers', 'courseId', 'dayId', 'daysMembers'));
    }

    public function updateAudience(Request $request, $courseId, $dayId)
    {
        $statusData = $request->input('status');
        foreach ($statusData as $memberId => $status) {

            DaysMembers::updateOrCreate(
                ['day_id' => $dayId, 'course_id' => $courseId, 'member_id' => $memberId],
                ['status' => $status],
            );
        }
        return back();
    }

    public function attendance_rate($id)
    {
        $course_members = CourseMembers::with('member')->where('course_id', $id)->get();
        foreach ($course_members as $member) {
            $attendance_count = DaysMembers::where('member_id', $member->member_id)
                ->where('course_id', $id)
                ->where('status', '1')
                ->count();

            $missed_count = DaysMembers::where('member_id', $member->member_id)
                ->where('course_id', $id)
                ->where('status', '0')
                ->count();
            $missed_legal_count = DaysMembers::where('member_id', $member->member_id)
                ->where('course_id', $id)
                ->where('status', '2')
                ->count();


            $member->attendance = $attendance_count;
            $member->missed = $missed_count;
            $member->missed_legal = $missed_legal_count;
        }
        $count_of_session = CouresDays::where('cousre_id', $id)->count();
        
        $course = Courses::findOrFail($id);
        $totalHours = CouresDays::where('cousre_id', $id)->sum('number_of_hours');
        $num_of_hours_remaining = (int)$course->number_of_hours - $totalHours;

        return view('CoursesTable.sessions.audience.member_attendance_rate', compact('course_members', 'count_of_session', 'course', 'num_of_hours_remaining'));
    }

    
}
