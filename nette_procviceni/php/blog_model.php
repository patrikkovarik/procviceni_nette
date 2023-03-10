<?php

namespace App\Models;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class BlogModel
{
    /** @var Context */
    private $db;

    public function __construct(Context $db)
    {
        $this->db = $db;
    }

    public function getUserByEmail(string $email): ?ActiveRow
    {
        return $this->db->table('users')->where('email', $email)->fetch();
    }

    public function getUserById(int $id): ?ActiveRow
    {
        return $this->db->table('users')->get($id);
    }

    public function getArticles(): Selection
    {
        return $this->db->table('articles')->order('created DESC');
    }

    public function getArticleById(int $id): ?ActiveRow
    {
        return $this->db->table('articles')->get($id);
    }

    public function createArticle(array $data): ActiveRow
    {
        return $this->db->table('articles')->insert($data);
    }

    public function updateArticle(int $id, array $data): void
    {
        $this->db->table('articles')->where('id', $id)->update($data);
    }

    public function deleteArticle(int $id): void
    {
        $this->db->table('articles')->where('id', $id)->delete();
    }

    public function getCommentsForArticle(int $articleId): Selection
    {
        return $this->db->table('comments')->where('article_id', $articleId)->order('created ASC');
    }

    public function createComment(array $data): ActiveRow
    {
        return $this->db->table('comments')->insert($data);
    }
}
?>