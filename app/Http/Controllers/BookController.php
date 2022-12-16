<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //show all books
    public function index()
    {
        return Book::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //validation
        $validator = Validator::make($input,[
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
        ]);
        //if validation fails it will return a message with an eror
        if($validator->fails()){
            return $this->sendError('validation Error', $validator->errors());
        }
        //otherwise it will store the book record and return response with message
        $book = Book::create($input);
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Book Record Created Succesfully',
            'book' => $book
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::find($id);
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


    //Update the book
    public function update(Request $request, $id)
    {
        //find book record by it's id
       if(Book::where('id',$id)->exists()){
        $book = Book::find($id);
        //if the book record exists it will retrieve in editable form
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        //and then save the updated record
        $book ->save();
        //and return a response with this message
        return response()->json([
            'message' => 'Book Record Updated Succesfully'
        ], 200);
       }
       //otherwise if book not found it will return this message
       else {
        return response()->json([
            'message' => 'Book Record Not Found'
        ], 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Delete book
    public function destroy($id)
    {
        if(Book::where('id',$id)->exists()){
            $book = Book::find($id);
            $book ->delete();
            return response()->json([
                'message' => 'Book Record Deleted Succesfully'
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Book Record Not Found'
            ], 404);
           }
    }
}
