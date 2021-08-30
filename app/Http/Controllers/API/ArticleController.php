<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\ArticleValidator;
use App\Repositories\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class ArticleController extends Controller
{
    
    private $articleValidator;
    private $articleRepository;

    public function __construct(Request $request , ArticleRepositoryInterface $articleRepository){
        $this->articleRepository = $articleRepository;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['store' , 'update'];
        if(in_array($actionName, $actoinNameForValidation)){
            $this->articleValidator = new ArticleValidator($request , $actionName);
        }
    }

    public function index()
    {
        //
    }

   
    public function create()
    {
        // 
    }

    
    public function store(Request $request)
    {
        $validator = $this->articleValidator->validate();

        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') , $validator->errors());
        }
        
        $article = $this->articleRepository->create($request->all());
        return $this->sendResponse($article, __('common.action_performed' , ['model' => 'Article' , 'action' => 'created']));
    }

    
    public function show(Article $article)
    {
        $data = $this->articleRepository->findById($article->id,['*'],['tags'],[]);
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Article' , 'action' => 'fetched']));
    }

   
    public function edit(Article $article)
    {
        //
    }

   
    public function update(Request $request, Article $article)
    {
        //
    }

    
    public function destroy(Article $article)
    {
        $deletedArticle = $this->articleRepository->deleteById($article->id);
        return $this->sendResponse($deletedArticle , __('common.action_performed' , ['model' => 'Article' , 'action' => 'deleted']));

    }
}
