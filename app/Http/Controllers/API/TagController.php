<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\TagValidator;
use App\Services\TagService;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{

    private $tagValidator;
    private $tagService;

    public function __construct(Request $request , TagService $tagService){
        $this->tagService = $tagService;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['store' , 'update'];
        if(in_array($actionName, $actoinNameForValidation)){
            $this->tagValidator = new TagValidator($request , $actionName);
        }
    }
   

    public function index()
    {
        $data = $this->tagService->getAll();
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Tags' , 'action' => 'fetched']));
    }


    public function store(Request $request)
    {
        $validator = $this->tagValidator->validate();
        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') ,400 ,$validator->errors());
        }

        $tag = $this->tagService->create($request->all());
        return $this->sendResponse(__('common.action_performed' , ['model' => 'Tag' , 'action' => 'created']),201,$tag);
    }


    public function show(Tag $tag)
    {
        $data = $this->tagService->findById($tag->id);
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Tag' , 'action' => 'fetched']));
    }


    public function update(Request $request, Tag $tag)
    {
        //
    }


    public function destroy(Tag $tag)
    {
        //
    }
}
