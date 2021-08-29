<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\TagValidator;
use App\Repositories\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{

    private $tagValidator;
    private $tagRepository;

    public function __construct(Request $request , TagRepositoryInterface $tagRepository){
        $this->tagRepository = $tagRepository;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['store' , 'update'];
        if(in_array($actionName, $actoinNameForValidation)){
            $this->tagValidator = new TagValidator($request , $actionName);
        }
    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->tagValidator->validate();
        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') , $validator->errors());
        }
        $tag = $this->tagRepository->create($request->all());
        return $this->sendResponse($tag , __('common.action_performed' , ['model' => 'Tag' , 'action' => 'created']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
