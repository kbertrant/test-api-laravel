<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
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
        * @OA\Post(
        * path="/api/like/post",
        * operationId="LikePost",
        * tags={"Like"},
        * summary="Like a post",
        * description="Like a post here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"post_id","user_id"},
        *               @OA\Property(property="post_id", type="integer"),
        *               @OA\Property(property="user_id", type="integer")
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
    public function likePost(Request $request)
    {

        $rules=array(
            'post_id'  =>"required",
            'user_id' =>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){ 
            Log::error('Register validation fails');
            return $validator->errors();}

        $post = Post::find($request->post_id);	
        $like = new Like();
        $like->user_id = $request->user_id;
        
        $post->likes()->save($like);

        $response = ["message" =>'Like a post!',"content"=>$post];
        return response($response, Response::HTTP_OK);
    }

    
    /**
        * @OA\Post(
        * path="/api/like/beat",
        * operationId="LikeBeat",
        * tags={"Like"},
        * summary="Like a beat",
        * description="Like a beat here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"beat_id","user_id"},
        *               @OA\Property(property="beat_id", type="integer"),
        *               @OA\Property(property="user_id", type="integer")
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
        public function likeBeat(Request $request)
        {
    
            $rules=array(
                'beat_id'  =>"required",
                'user_id' =>"required"
            );
            $validator=Validator::make($request->all(),$rules);
            if($validator->fails()){ return $validator->errors();}
    
            $beat = Beat::find($request->beat_id);	
            $like = new Like();
            $like->user_id = $request->user_id;
            
            $beat->likes()->save($like);
    
            $response = ["message" =>'Like a beat !',"content"=>$beat];
            return response($response, Response::HTTP_OK);
        }
    

}
