<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
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
        * path="/api/store/comment",
        * operationId="AddComment",
        * tags={"Comment"},
        * summary="Add a comment",
        * description="Add new comment here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"comment","post_id"},
        *               @OA\Property(property="comment", type="text"),
        *               @OA\Property(property="post_id", type="integer")
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
            'comment'  =>"required",
            'post_id' =>"required"
        );

        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            Log::error("Validation error");
            return $validator->errors();}

        $mypost = Post::find($request->post_id);
        $mycom = new Comment();
        $mycom->comment = $request->comment;
        $mycom->post_id = $request->post_id;
        $mypost->comments()->save($mycom);
        Log::info('Ajouter un commentaire OK');

        $response = ["message" =>'New comment',"content"=>$mycom];
        return response($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $postComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $postComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $postComment)
    {
        //
    }
}
