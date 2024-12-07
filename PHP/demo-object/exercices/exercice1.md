### Exercice : Système de Gestion de Fichiers en PHP

**Objectif** : Construire une application console en PHP qui permet de créer, lire, et supprimer des fichiers. L'application utilisera la programmation orientée objet et implémentera des fonctionnalités avancées de PHP, interface, trait,namespace, Exception,...

```php
interface FileInterface {
    public function read();
    public function write($content);
    public function delete();
}

trait OsTrait {
    protected function exists() {
        return file_exists($this->path);
    }
}

class File implements FileInterface {
    use OsTrait;

    public function __construct(private string $path) {
        
    }

    public function read() {

    }
    public function write($content) {

    }
    public function delete() {

    }
}

```