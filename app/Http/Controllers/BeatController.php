<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        * @OA\Post(
        * path="/api/store/beat",
        * operationId="AddBeat",
        * tags={"Beat"},
        * summary="Add a beat",
        * description="Add new beat here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"slug","title","premium_file","free_file"},
        *               @OA\Property(property="slug", type="text"),
        *               @OA\Property(property="title", type="text"),
        *               @OA\Property(property="premium_file", type="file"),
        *               @OA\Property(property="free_file", type="file"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function store(Request $request)
        {
            $rules=array(
                'slug'  =>"required|unique:beats",
                'title' =>"required",
                'free_file' =>"required",
                'premium_file' =>"required"
            );
    
            $validator=Validator::make($request->all(),$rules);
            if($validator->fails()){ 
                Log::error('Register validation fails');
                return $validator->errors();}
            if($request->file('free_file') || $request->file('premium_file')) {

                $freeName = $request->file('free_file')->getClientOriginalName();
                $premiumName = $request->file('premium_file')->getClientOriginalName();
                $freePath = $request->file('free_file')->storeAs('uploads/free', $freeName, 'public');
                $premiumPath = $request->file('premium_file')->storeAs('uploads/premium', $premiumName, 'public');
                
                $mybeat = new Beat();
                $mybeat->slug = $request->slug;
                $mybeat->title = $request->title;
                $mybeat->free_file = '/storage/'.$freePath;
                $mybeat->premium_file = '/storage/'.$premiumPath;
                $mybeat->save();
                
            }
            
            $response = ["message" =>'Nouveau Beat',"content"=>$mybeat];
            return response($response, Response::HTTP_OK);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beat  $beat
     * @return \Illuminate\Http\Response
     */
    public function show(Beat $beat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beat  $beat
     * @return \Illuminate\Http\Response
     */
    public function edit(Beat $beat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beat  $beat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beat $beat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beat  $beat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beat $beat)
    {
        //
    }
}
