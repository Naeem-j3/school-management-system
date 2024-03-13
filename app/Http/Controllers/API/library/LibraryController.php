<?php

namespace App\Http\Controllers\API\library;

use App\Http\Controllers\Controller;
use App\Http\Trait\AttachFilesTrait;
use App\Models\Library;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class LibraryController extends Controller
{
    use AttachFilesTrait;
    public string $path='attachments/library';
    public string $disk='attachment';
    public function index()
    {
        $books = Library::with('grade:id,name','teacher:id,name','classroom:id,naem','section')->get();
        if(isEmpty($books)){
            return response()->json(['books'=>$books,'message'=>'there is no books yet'] );
        }
        return response()->json(['books'=>$books], 200 );
    }

    public function store(Request $request)
    {
        try {


            $book= Library::create([
                'title'=>$request['title'],
                'file_name'=> $request['file_name']->getClientOriginalName(),
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'section_id'=>$request['section_id'],
                'teacher_id'=>$request['teacher_id']
            ]);
            $this->uploadFile($request['file_name'],$this->path,$this->disk);
            $data['book']=Library::where('id',$book['id'])
                ->with('grade:id,name','teacher:id,name','classroom:id,name','section')->get();
            return response()->json(['book'=>$data['book'],'message'=>'there book created successfully'] );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request,$id)
    {
        try {

            $book = library::find($id);
            $book->title = $request->title;

            if($request->hasfile('file_name')){
                $this->deleteFile($this->path,$this->disk);
                $this->uploadFile($request['file_name'],$this->path,$this->disk);
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->grade_id = $request->grade_id;
            $book->class_id = $request->class_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();

            $data['book']=Library::where('id',$book['id'])
                ->with('grade:id,name','teacher:id,name','classroom:id,name','section')->get();
            return response()->json(['book'=>$data['book'],'message'=>'there book updated successfully'] );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $book=Library::find($id);
        if(!$book){
            return response()->json(['message' => 'book not found'], 404);
        }
        $this->deleteFile($this->path.'/'.$book->file_name,$this->disk);
        $book->delete();
        return response()->json(['message' => 'book deleted successfully'], 200);
    }

    public function download($id)
    {
        $filename=Library::where('id',$id)->first()->file_name;

        return response()->download(public_path($this->path.'/'.$filename));
    }
}
