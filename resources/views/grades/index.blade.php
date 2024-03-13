@extends('layouts.app')
{{-- <link href="{{url('build/assets/indexStyle.css')}}" rel="stylesheet"> --}}


        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          @section('header')
Grades
          @endsection
        </h1>


    @section('content')


    <div class="  mt-20  w-full text-left text-black  ">
        <table class="w-full text-2xl text-left ">
            <thead  class="  tt">
                <tr >
                    <th scope="col" class="px-6 py-3 ">
                        grade name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        note
                    </th>
                    <th scope="col" colspan="1" class="px-6 py-3">
                        Actions
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)


                <tr class="bg-white border-b ">
                    <td  scope="row" class="px-6 py-4 font-medium ">
                        {{ $grade->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $grade->note }}
                    </td>
                    <td class="px-6 py-4">
                            <div class="bg-cyan-800  p-2 text-white w-20 text-center">
                                <a  href="#popup2">edit</a>
                            </div>


                    </td>
                    <td class="px-6 py-4">
                        <form action="/grades/{{ $grade->id }}"  method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 p-2 text-white w-20">delete</button>
                        </form>
                    </td>
                </tr>
                <div id="popup2" class="overlay">
                    <div class="popup">

                        <a class="close" href="#">&times;</a>
                        <div class="content">

                            <form action="/grades/{{ $grade->id }}" method='post'>
                                @csrf
                            @method('PUT')
                                <input type="text" name="grade_name" value="{{ $grade->name }}"  class="block m-2" placeholder="grade name" required >
                                <br>
                                <input type="text" name="notes" value="{{ $grade->note }}" class="block m-2"  placeholder="your notes here">
                                <button type="submit" class="bg-green p-2 block mt-5">update</button>
                            </form>


                        </div>

                    </div>

                </div>
                @endforeach

            </tbody>
        </table>
    </div>


<div class="box">
	<a class="button bg-cyan-800 p-4 rounded-lg text-white text-7xl " href="#popup1">create new grade</a>
</div>

<div id="popup1" class="overlay">
	<div class="popup">

		<a class="close" href="#">&times;</a>
		<div class="content">

            <form action="{{ route('grades.store') }}" method='post'>
                @csrf

                <input type="text" name="grade_name" class="block m-2" placeholder="grade name" required c>
                <br>
                <input type="text" name="notes" class="block m-2" placeholder="your notes here">
                <button type="submit" class="bg-green p-2 block mt-5">create</button>
            </form>

		</div>

	</div>

</div>





<script src="build/assets/main.js"></script>
    @endsection

