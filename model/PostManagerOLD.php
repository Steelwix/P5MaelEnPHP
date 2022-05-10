
namespace OpenClassrooms\Blog\Model;
use Manager;
require_once("model/Manager.php");



class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT idPost, title, hat, content, id, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post ORDER BY updateDate DESC LIMIT 0, 5');
        return $req;
        if ($req === false) {
            var_dump($db->errorInfo());
            die('Erreur SQL Post');
        }
    }

    public function getPost($idPost)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT idPost, title, hat, content, id, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE idPost = ?');
        $req->execute(array($idPost));
        $post = $req->fetch();

        return $post;
    }
}
