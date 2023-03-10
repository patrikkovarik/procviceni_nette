<?php
namespace App\Presenters;

use App\Model\ArticleManager;

class ArticlePresenter extends BasePresenter
{
    /** @var ArticleManager */
    private $articleManager;

    public function __construct(ArticleManager $articleManager)
    {
        $this->articleManager = $articleManager;
    }

    public function renderDefault()
    {
        $articles = $this->articleManager->findAllPublished();
        $this->template->articles = $articles;
    }

    public function renderDetail($id)
    {
        $article = $this->articleManager->findById($id);
        if (!$article) {
            $this->error('Článek nebyl nalezen.');
        }

        $this->template->article = $article;
    }
}
?>