<?php


namespace App\Repository\student;

use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiptStudentsRepository implements ReceiptStudentsRepositoryInterface
{

    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return response()->json(['receipt_students '=>$receipt_students ]);

    }


    public function store($request)
    {
        DB::beginTransaction();

        try {


            $receipt_students =ReceiptStudent::create([
                'date'=>now(),
                'student_id'=>$request->student_id,
                'debit'=>$request->debit,
                'description'=>$request->description,
            ]);

            // حفظ البيانات في جدول الصندوق

            FundAccount::create([
                'date'=>now(),
                'receipt_id'=>$receipt_students['id'],
                'debit'=>$request->debit,
                'credit'=>0.00,
                'description'=>$receipt_students['description']
            ]);


            StudentAccount::create([
                'invoice_date'=>now(),
                'student_id' => $request['student_id'],
                'receipt_id'=> $receipt_students['id'],
                'debit' => 0.00,
                'credit' => $request['debit'],
                'description' => $request['description'],
            ]);

            DB::commit();

            return response()->json(['message'=>'receipt_students created successfuly',200]);

        }

        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update($request,$id)
    {
        DB::beginTransaction();

        try {

           $receipt_students=ReceiptStudent::where('id',$id)->first();
            $receipt_students->update([
                'date'=>now(),
                'student_id'=>$request->student_id,
                'debit'=>$request->debit,
                'description'=>$request->description,
            ]);

            // حفظ البيانات في جدول الصندوق
            $receipt_students->fundAccounts()->update([
                'date'=>now(),
                'receipt_id'=>$receipt_students['id'],
                'debit'=>$request->debit,
                'credit'=>0.00,
                'description'=>$receipt_students['description']
            ]);


            $receipt_students->studentAccounts()->update([
                'invoice_date'=>now(),
                'student_id' => $request['student_id'],
                'receipt_id'=> $receipt_students['id'],
                'debit' => 0.00,
                'credit' => $request['debit'],
                'description' => $request['description'],
            ]);

            DB::commit();

            return response()->json(['message'=>'receipt_students updated successfuly',200]);

        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
            ReceiptStudent::destroy($id);
            return response()->json(['message'=>'ReceiptStudent deleted successfuly']);
    }
}
