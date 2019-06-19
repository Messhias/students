# Students framework

This repository it's test creation of an framework in **PHP**.


### Libraries used:

Here's the following list of libraries / ger used to build the 
framework.

- [PHP7](https://www.php.net) – This framework is build based
on latest version of PHP, and the minimal version you need to run it it's **PHP 7.1**.

- [Twig](https://twig.symfony.com/) – for template rendering.

- [MariaDB](https://mariadb.org/) - for database.

- [Composer](https://getcomposer.org/).

- [Nginx](https://www.nginx.com/) - webserver

All those libraries / system in [Dockerfile](https://github.com/Messhias/students/blob/master/docker/php/Dockerfile), 
 [docker-compose.yml](https://github.com/Messhias/students/blob/master/docker-compose.yml) and 
 [composer.json](https://github.com/Messhias/students/blob/master/composer.json) files.
 
 So if you go through the docker approach for run you don't need to care to 
 install manually those libraries / gear.

# Running and testing

In order to run this framework is suggest user docker for a self contained 
configuration and no need additional installation of packages and anything else.

### Set up with docker:

First you need install `docker` on your machine, for this just
enter in the following link:

- [Docker](https://www.docker.com/)

After installed docker you can simple set up your application using the following commands:

- certificate your docker instance is running by.
 `docker` if everything is fine you'll see a list. 
 of possible commands.
- go to application directory. 
- run `docker build .`.
- check if the containers is working by `docker images`. You will see a list 
of current images that you have.
- after you can run your container by ways, detach mode or attach mode.

**To run in detach mode** –> `docker-compose up -d`

**Default** –> `docker-compose up`

Usually the docker containers in build process install the [composer](https://getcomposer.org/) for you. But to 
avoid problems / mistakes run the following command:

`docker-compose run composer composer install` or `docker-compose run composer composer update`

if you want to add new packages you can run:

`docker-composer run composer composer require <package-name>`

After set up the container you need to run the  [database.sql](https://github.com/Messhias/students/blob/master/database.sql)
 in your database, your the credentials containing in the [docker-compose.yml](https://github.com/Messhias/students/blob/master/docker-compose.yml)
 file and done, you ready to go!
 
 ### Why I should use docker?
 
 For the following reasons:
 
 - Since everything's running inside the containers you don't need to do the exhausting workg to install everything.
 - The docker is based based on php-fpm image, you don't know you it? [So read about php-fpm](https://php-fpm.org/)
 - The [Dockerfile](https://github.com/Messhias/students/blob/master/docker/php/Dockerfile) it'll configure automatically the fpm pool and the 
  [opcache](https://github.com/Messhias/students/blob/master/docker/php/conf.d/opcache.ini) features for you.
  - If someting goes wrong you can easily delete the container.
  - After the user you can delete the container without affecting your operational system.
  - Since it's containers you can delete after the use without headaches about to damage your system.
  
  You can read a lot [articles in this search](https://www.google.com/search?q=advantages+to+user+docker&oq=advantages+to+user+docker&aqs=chrome..69i57j0l5.4296j0j7&sourceid=chrome&ie=UTF-8) of the 
  advantages of the use the docker in development process.
  
  # I don't want to use docker, what I have to do?!
  
  ### Just to remember, this framework was tested and running in docker enviromnent, if you to go to your installation it's your responsability to make it work!
  
  Well, if for some reason or limitation you cannot use docker, you need some process to follow:
  
  - You need to install [MariaDB](https://mariadb.org/)
  - After install the [MariaDB](https://mariadb.org/) database you need to install the
   [PHP 7.1](http://php.net) (minimal version require to use the framework).
   - After that you need to install the [composer](https://getcomposer.org/)
   - Some web server for your PHP, you have a lot options like [apache](https://www.apache.org/), 
   [nginx](https://www.nginx.com/) or you canse use the 
   [PHP built-in server](https://www.php.net/manual/en/features.commandline.webserver.php).
   - [Composer](https://getcomposer.org/) to install the libraries.
   
   After you set up everything ***dont forgot to run the composer install or composer update please!***
   
   
   
   #Connecting to database.
   
   For this framework to connect to database for nw isn't handled by 
   .env variables (at the end of this readme has the considerations). So
   you need to change the connection in the [Config.php](https://github.com/Messhias/students/blob/master/App/Config.php), 
   on the future we can implement the .env files handler.
   
   
   Here's the structure of the file:
  
   ```
  <?php
  
  /**
   * @author Fabio William Conceição 
   */
  
  namespace App;
  
  
  /**
   * Application configuration
   *
   * PHP version 7.1
   */
  class Config
  {
      /**
       * Database host
       * @var string
       */
      const DB_HOST = "database_students";
  
      /**
       * Database name
       * @var string
       */
      const DB_NAME = 'students_docker';
  
      /**
       * Database user
       * @var string
       */
      const DB_USER = 'root';
  
      /**
       * Database password
       * @var string
       */
      const DB_PASSWORD = 'docker';
  
      /**
       * Show or hide error messages on screen
       * @var boolean
       */
      const SHOW_ERRORS = true;
  }
```

#Routing system:

To route you need do it directly by [public/index.php](https://github.com/Messhias/students/blob/master/public/index.php) 
file.

Here's an example of route:

```
/**
 * Routing
 */
$router = new Core\Router();

// home router
$router->add('', ['controller' => 'HomeController', 'action' => 'index', "title"]);
$router->add('{controller}/{action}');
$router->add('/', ['controller' => 'HomeController', 'action' => 'index', "title"]);
$router->add('{controller}/{action}');
```

# Controllers:

Here's an example to of the application controller:

```
<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use Core\View;

/**
 * HomeController controller
 *
 * PHP version 7.1
 */
class HomeController extends ResourceController
{
    /**
     * HomeController constructor.
     *
     * @param $route_params
     */
    public function __construct($route_params)
    {
        $this->setRepository(new UserRepository());
        parent::__construct($route_params);
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.php', [
            "students" => $this->getRepository()->get(),
        ]);
    }
}
```

In this controller we follow the best practices.

We have one repository responsible to communicate with 
our controller and business model and sent the answer to your views, json responses 
and etc.

You don't know what's repository pattern? 
[Here's you can find a nice article for that](https://medium.com/@pererikbergman/repository-design-pattern-e28c0f3e4a30) 

All the controller extends the [ResourceController.php](https://github.com/Messhias/students/blob/master/App/Controllers/ResourceController.php).


#View systems:

All the views could be create in the `Views` folder with extension .html, .php without problems and uses
 the [twig template](https://twig.symfony.com).
 
 Here's a example of an view:
 
 ```
 {% extends "base.html" %} // could extend an .php file too!
 
 {% block title %}Page not found{% endblock %}
 
 {% block body %}
 
     <h1>Page not found</h1>
     <p>Sorry, that page doesn't exist.</p>
 
 {% endblock %}

 ```
 
 All the views system extends from [Views core application file](https://github.com/Messhias/students/blob/master/Core/View.php).
 
 #Models:
 
 You don't need to make your models extends the [Model application core](https://github.com/Messhias/students/blob/master/Core/Model.php) since the framework use 
 the repository pattern to do the layer beteween controller and model.
 
 But if for some reason you need to create a model without a repository 
 controlling it you can easily extends it by:
 
 ````
 <?php
 
 namespace App\Models;
 
 use Core\Model;
 
 class MyModel extends Model {
    // do your model stuff here.
 }
 
 ````
 
 
 Regarding that here's an example of the default model in the framework:
 
 ````
 <?php
 /**
  * @author Fabio William Conceição
  */
 
 namespace App\Models;
 
 /**
  * User (students) model.
  *
  * PHP version 7.1
  */
 class User
 {
     /**
      * No one outside model needs know which table we're using right?!
      * @var string
      */
     private $table = "students";
 
     /**
      * @return string
      */
     public function getTable(): string
     {
         return $this->table;
     }
 
     /**
      * @param string $table
      */
     public function setTable(string $table): void
     {
         $this->table = $table;
     }
 }
 ````
 
 #Repository:
 
 Since the main goal of this framework it's mainting the usability of the best pratictes we strongly suggest 
 to you repository pattern (you can read more in Practices section) 
 to help you to implement SOLID principles into your application.
 
 By the default you can find [in this file](https://github.com/Messhias/students/blob/master/App/Repository/Repository.php) 
 the default extends application repository, feel free to 
 update it, alter it.
 
 Here's the structure of the file:
 
 ```
 <?php
 
 namespace App\Repository;
 
 use Core\Model;
 
 /**
  * This class it's the layer of abstraction between the model and controller.
  *
  * The main role of the class it's protect the model for the controller issues and also
  * encapsulate all the necessary built-in default models operations into an repository.
  *
  * Class Repository
  * @package App\Repository
  */
 abstract class Repository extends Model
 {
     /**
      * Set up the repository
      *
      * Repository constructor
      */
     public function __construct()
     {
         $this->model();
     }
 
     /**
      * The model only can be accessible by the classes which extends it.
      *
      * @var $model
      */
     protected $model;
 
     /**
      * @return mixed
      */
     public function getModel()
     {
         return $this->model;
     }
 
     /**
      * Function responsible to set up the model in each repository
      *
      * @return mixed
      */
     abstract protected function model();
 }
 ```
 
 
 And here's an file extending it:
 
 ````
 <?php
 /**
  * @author Fabio William Conceição
  */
 
 namespace App\Repository;
 
 use App\Models\User;
 use Exception;
 use PDO;
 
 /**
  * Repository class to represent the abstraction of the user model.
  *
  * Class UserRepository
  * @package App\Repository
  */
 class UserRepository extends Repository
 {
     /**
      * @var mixed
      */
     private $db;
 
     /**
      * Set up the class constructor and call the parent class constructor.
      *
      * UserRepository constructor.
      */
     public function __construct()
     {
         parent::__construct();
         $this->setDb(static::getDB());
     }
 
     /**
      * @return mixed
      */
     public function getDbRepo()
     {
         return $this->db;
     }
 
     /**
      * @param mixed $db
      */
     public function setDb($db): void
     {
         $this->db = $db;
     }
 
     /**
      * Function responsible to set up the model in each repository
      *
      * @return mixed
      */
     protected function model()
     {
         $this->model = new User();
     }
 
     /**
      * Get all the users as an associative array
      *
      * @return array
      */
     public function get()
     {
         $query = "select * from {$this->model->getTable()} order by id desc";
         $stmt = $this->getDbRepo()->query($query);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
 
     /**
      * Add new data in repository.
      *
      * just pass pair array with key / value and function it'll transpile it for sql statement for you.
      *
      * @param array $data
      *
      * @return bool
      * @throws Exception
      */
     public function create($data = [])
     {
 
         try {
             $columns = [];
             $values = [];
 
             // removing the id index.
             unset($data['id']);
 
             foreach ($data as $key => $value) {
                 if ($key === "classroom") $key = "class";
                 $columns[] = $key;
                 if ($key == "year_joined") $values[] = "'" . date("Y-m-d H:m:s", strtotime($value)) . "'";
                 else $values[] = "'" . $value . "'";
             }
 
             $columns = join(",", $columns);
             $values = join(",", $values);
 
             $query = "insert into {$this->model->getTable()}({$columns}) values({$values})";
 
             $stmt = $this->getDbRepo();
             $stmt->beginTransaction();
             $stmt->exec($query);
             $stmt->commit();
 
             return true;
         } catch (Exception $e) {
             $stmt->rollback();
             print_r($query);
             throw $e;
         }
     }
 
     /**
      * Find by ID.
      *
      * If the ID doesn't exist in the array collection returns false.
      *
      * @param array $data
      *
      * @return bool
      * @throws Exception
      */
     public function find($data = [])
     {
         try {
             if (!array_key_exists('id', $data)) return false;
 
             $id = $data["id"];
             $query = "select * from {$this->model->getTable()} where id = {$id}";
             $stmt = $this->getDbRepo()->query($query);
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
             throw $e;
         }
     }
 
     /**
      * Update student entry in database.
      *
      * @param array $data
      *
      * @return bool
      * @throws Exception
      */
     public function update($data = [])
     {
         try {
             if (!array_key_exists('id', $data)) return false;
             $update = [];
 
             $id = $data["id"];
             $data['date_updated'] = date("Y-m-d H:m:s");
             unset($data['id']);
 
             foreach ($data as $key => $value) {
                 if ($key == "classroom") $key = "class";
 
                 $update[] = $key . " = '" . $value . "'";
             }
 
             $values = join(",", $update);
             $query = "update {$this->model->getTable()} set {$values} where id = {$id}";
 
             $stmt = $this->getDbRepo();
             $stmt->beginTransaction();
             $stmt->exec($query);
             $stmt->commit();
 
             return true;
         } catch (Exception $e) {
             throw $e;
         }
     }
 
     public function delete($data = [])
     {
         try {
             if (!array_key_exists('id', $data)) return false;
 
             $id = $data["id"];
 
             $query = "delete from {$this->model->getTable()} where id = {$id}";
 
             $stmt = $this->getDbRepo();
             $stmt->beginTransaction();
             $stmt->exec($query);
             $stmt->commit();
 
             return true;
         } catch (Exception $e) {
             throw $e;
         }
     }
 }
 ````
 
 # Considerations:
 
 Ok, after this long journey reading about it probably as you see we have
  a lot considerations about of the framework like:
  
  
 **Security**

Yes, the framework for now doesn't have a security patterns, don't 
sanitize the queries and don't check for 
cross browsers attacks.

Since this is a huge feature to implement it's something we cannot do it quicker.

**Scalability**

For now, the framework it's on the scalability path, but we have some toughs of what we
can do something to do better.

For example, we're using the Twig for template and routing system but we still don't
support for HTTP verboses (PUT, PATCH, DELETE).

And there's more we can list here.


# Practices:

To build this framework we use the best practices in PHP Development:

- [SOLID](https://medium.com/thiago-aragao/solid-princ%C3%ADpios-da-programa%C3%A7%C3%A3o-orientada-a-objetos-ba7e31d8fb25).

- [Repository Pattern](https://deviq.com/repository-pattern/).

- [PHP-FIG](https://www.php-fig.org/)

- [KISS Principle](https://en.wikipedia.org/wiki/KISS_principle)


# And now?

Well after this initial setup the only thing we can do it it's keep studying, updating and 
make it more and even better.

I hope you have fun testing my framework.