<?php
namespace App\Repository\student;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {
        $Fee_invoices = FeeInvoice::with('grade','classroom','section','student:id,name','fees')->get();
        return response()->json(['fee_invoices'=>$Fee_invoices],200);
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        $fees = Fee::where('class_id',$student->class_id)->get();
        $data['student']=$student;
        $data['fees']=$fees;
        return response()->json(['data'=>$data],200);    }

        public function store($request)
        {

            DB::beginTransaction();
            try {
                $student = Student::findorfail($request['student_id']);
                $fee = Fee::findorfail($request['fee_id']);
                    // Create a new FeeInvoice record

                   $feeInvoice= FeeInvoice::create([
                        'invoice_date' => now(),
                        'student_id' => $request['student_id'],
                        'grade_id' => $student['grade_id'],
                        'class_id' => $student['class_id'],
                        'fee_id' => $request['fee_id'],
                        'amount' => $fee['amount'],
                        'description' => $request['description'],
                    ]);
                    // Create a new StudentAccount record
                    StudentAccount::create([
                        'invoice_date'=>now(),
                        'student_id' => $request['student_id'],
                        'feeInvoic_id'=> $feeInvoice['id'],
                        'debit' => $fee['amount'],
                        'credit' => 0.00,
                        'description' => $request['description'],
                    ]);


                DB::commit();

                return response()->json(['message'=>'fee invoice created successfuly'],200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e->getMessage()]);
            }
        }
        public function update($request,$id)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = FeeInvoice::findorfail($id);
            $Fees->update([
                'fee_id' => $request['fee_id'],
                'amount' => $request['amount'],
                'description' => $request['description'],
            ]);
            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('feeInvoic_id',$request->id)->first();
            $StudentAccount->update([
                'Debit' =>$request['amount'],
                'description' =>$request['description'],

            ]);
            DB::commit();
            return response()->json(['messsage'=> 'fee invoice updated seccessfuly']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
            FeeInvoice::destroy($id);
            return response()->json(['messsage'=> 'fee invoice deleted seccessfuly']);
    }

}
