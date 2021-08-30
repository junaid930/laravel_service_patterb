<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\ArticleValidator;
use App\Services\ArticleService;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    
    private $articleValidator;
    private $articleService;

    public function __construct(Request $request , ArticleService $articleService){
        $this->articleService = $articleService;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['store' , 'update'];
        if(in_array($actionName, $actoinNameForValidation)){
            $this->articleValidator = new ArticleValidator($request , $actionName);
        }
    }


    public function index()
    {
        $data = $this->articleService->getAll();
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Articles' , 'action' => 'fetched']));
    }

    
    public function store(Request $request)
    {
        $validator = $this->articleValidator->validate();
        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') , $validator->errors());
        }

        $article = $this->articleService->create($request->all());
        return $this->sendResponse($article, __('common.action_performed' , ['model' => 'Article' , 'action' => 'created']));
    }

    
    public function show(Article $article)
    {
        $data = $this->articleService->findById($article->id);
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Article' , 'action' => 'fetched']));
    }

   
    public function update(Request $request, Article $article)
    {
        //
    }

    
    public function destroy(Article $article)
    {
        // 
    }
}
