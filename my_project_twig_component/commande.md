Pour intégrer **LiveComponents** et **TwigComponents** dans votre projet Symfony, vous devez suivre les étapes suivantes. Je vais vous donner les commandes d'installation, une explication de leur utilisation et des exemples variés et complexes.

---

### **Étapes d'installation**

1. **Installer Symfony UX** :
   Symfony UX est une bibliothèque qui facilite l'intégration d'outils front-end avec Symfony. Assurez-vous que `symfony/ux-live-component` et `symfony/ux-twig-component` sont installés.

   ```bash
   composer require symfony/ux-twig-component
   composer require symfony/ux-live-component
   ```

2. **Installer Stimulus** (si ce n'est pas déjà fait) :
   Stimulus est le gestionnaire JavaScript requis pour que les composants Live fonctionnent.

   ```bash
   composer require symfony/ux-turbo
   yarn install
   yarn dev
   ```

3. **Configurer Stimulus** :
   Stimulus est généralement configuré automatiquement par Symfony, mais vérifiez que le fichier `assets/controllers.json` contient bien les contrôleurs nécessaires.

   Par exemple :
   ```json
   {
       "controllers": {
           "@symfony/ux-live-component": {
               "live": {
                   "enabled": true
               }
           }
       }
   }
   ```

4. **Configurer les assets** :
   Assurez-vous que votre base HTML (par exemple `base.html.twig`) inclut les fichiers nécessaires au bon fonctionnement de Stimulus.

   ```twig
   {{ stimulus_controller('@symfony/ux-live-component/live') }}
   ```

5. **Activer les composants Twig** (optionnel) :
   Ajoutez cette ligne à votre fichier `config/packages/twig.yaml` si elle n’est pas encore présente :

   ```yaml
   twig:
       default_path: '%kernel.project_dir%/templates'
       paths:
           '%kernel.project_dir%/components': components
   ```

---

### **Créer des TwigComponents**

1. **Créer un composant Twig de base** :
   Exemple : un composant pour afficher un bouton de création.

   **Commandes** :
   ```bash
   bin/console make:twig-component ButtonCreate
   ```

   **Structure créée** :
    - **Class** : `src/Twig/Component/ButtonCreateComponent.php`
    - **Template** : `templates/components/button_create.html.twig`

   **Fichier `ButtonCreateComponent.php`** :
   ```php
   namespace App\Twig\Component;

   use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

   #[AsTwigComponent('button_create')]
   class ButtonCreateComponent
   {
       public string $label = 'Create';
       public string $url = '#';
   }
   ```

   **Template `button_create.html.twig`** :
   ```twig
   <a href="{{ url }}" class="btn btn-primary">{{ label }}</a>
   ```

   **Utilisation dans Twig** :
   ```twig
   <x-button-create label="Add Post" url="{{ path('post_create') }}" />
   ```

---

### **Créer des LiveComponents**

1. **Créer un composant Live pour gérer une liste de posts dynamiques** :
   Exemple : Mettre à jour dynamiquement la liste des posts à chaque ajout.

   **Commandes** :
   ```bash
   bin/console make:live-component PostList
   ```

   **Structure créée** :
    - **Class** : `src/LiveComponent/PostListComponent.php`
    - **Template** : `templates/live/post_list.html.twig`

   **Fichier `PostListComponent.php`** :
   ```php
   namespace App\LiveComponent;

   use Symfony\UX\LiveComponent\DefaultActionTrait;
   use Symfony\UX\LiveComponent\Attribute\LiveProp;
   use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
   use App\Entity\Post;
   use App\Repository\PostRepository;

   #[AsLiveComponent('post_list')]
   class PostListComponent
   {
       use DefaultActionTrait;

       #[LiveProp(writable: true)]
       public array $posts = [];

       public function __construct(private PostRepository $postRepository)
       {
           $this->posts = $this->postRepository->findAll();
       }

       public function refresh(): void
       {
           $this->posts = $this->postRepository->findAll();
       }
   }
   ```

   **Template `post_list.html.twig`** :
   ```twig
   <div>
       <ul>
           {% for post in posts %}
               <li>{{ post.title }} ({{ post.category.name }})</li>
           {% endfor %}
       </ul>
       <button data-action="live#refresh">Refresh List</button>
   </div>
   ```

   **Utilisation dans Twig** :
   ```twig
   <live:post-list />
   ```

---

### **Composant complexe : Formulaire en LiveComponent**

1. **Créer un LiveComponent pour gérer un formulaire dynamique** :
   Exemple : Ajout dynamique d’un post.

   **Commandes** :
   ```bash
   bin/console make:live-component PostForm
   ```

   **Fichier `PostFormComponent.php`** :
   ```php
   namespace App\LiveComponent;

   use Symfony\UX\LiveComponent\DefaultActionTrait;
   use Symfony\UX\LiveComponent\Attribute\LiveProp;
   use Symfony\UX\LiveComponent\Attribute\LiveAction;
   use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
   use App\Entity\Post;
   use App\Repository\CategoryRepository;
   use Doctrine\ORM\EntityManagerInterface;

   #[AsLiveComponent('post_form')]
   class PostFormComponent
   {
       use DefaultActionTrait;

       #[LiveProp(writable: true)]
       public string $title = '';

       #[LiveProp(writable: true)]
       public string $content = '';

       #[LiveProp(writable: true)]
       public int $categoryId = 0;

       private $categories;

       public function __construct(private EntityManagerInterface $em, CategoryRepository $categoryRepository)
       {
           $this->categories = $categoryRepository->findAll();
       }

       #[LiveAction]
       public function save(): void
       {
           $category = $this->em->getRepository(Category::class)->find($this->categoryId);

           $post = new Post();
           $post->setTitle($this->title);
           $post->setContent($this->content);
           $post->setCategory($category);

           $this->em->persist($post);
           $this->em->flush();
       }
   }
   ```

   **Template `post_form.html.twig`** :
   ```twig
   <form data-action="live#save">
       <input type="text" name="title" data-model="title" placeholder="Title" required />
       <textarea name="content" data-model="content" placeholder="Content" required></textarea>
       <select name="category_id" data-model="categoryId">
           {% for category in categories %}
               <option value="{{ category.id }}">{{ category.name }}</option>
           {% endfor %}
       </select>
       <button type="submit">Save</button>
   </form>
   ```

   **Utilisation dans Twig** :
   ```twig
   <live:post-form />
   ```

---

### **Exemples avancés combinant Live et TwigComponents**

1. Liste et formulaire combinés :
   ```twig
   <div>
       <live:post-form />
       <live:post-list />
   </div>
   ```

2. Interaction entre composants :
    - Après la sauvegarde dans `PostFormComponent`, émettez un événement pour déclencher un rafraîchissement de `PostListComponent`.

   ```php
   #[LiveAction]
   public function save(): void
   {
       $this->dispatchBrowserEvent('post:created');
   }
   ```

   Dans `post_list.html.twig` :
   ```twig
   <div>
       <ul>
           {% for post in posts %}
               <li>{{ post.title }}</li>
           {% endfor %}
       </ul>
       <button data-action="live#refresh">Refresh</button>
   </div>
   ```

   Ajoutez un écouteur JS :
   ```javascript
   document.addEventListener('post:created', () => {
       // Rafraîchir la liste des posts
   });
   ```

---

### **Pour aller plus loin**
- Combinez LiveComponents et Turbo Frames pour des performances maximales.
- Personnalisez les templates et actions pour répondre aux besoins spécifiques.

Ces outils sont puissants pour rendre votre projet Symfony interactif et moderne.