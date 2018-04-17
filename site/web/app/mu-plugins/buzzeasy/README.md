# Mr B Plugin
This is designed to be a starter skeleton for a typical "functionality plugin" in a Mr B WordPress project. It provides the ability to set up custom post types with taxonomies, and a way to interact with the database.

### Contents:
[Setup](#setup):

- Cloning
- Installation
- Configuration

[Custom Post Types](#custom-post-types):

- Adding custom post types
- Adding taxonimies
- Connecting post types to other post types
- Adding custom post type functions

[Querying Post Types](#querying-post-types):

- `first()`
- `find(int $id)`
- `all()`
- `get()`
- `where(array $parameters)`
- `whereTaxonomy(array $parameters)`
- `limit(int $limit)`
- `orderBy(string $column, string $direction)`
- `connected(int $id, string $postType)`

---

## Setup
1. `cd` into your `plugins` directory
1. Clone the `Mr B Plugin` repository and remove git references:
    ```
    git clone --depth=1. git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/mrb-wordpress-plugin-skeleton.git && rm -rf mrb-  wordpress-plugin-skeleton/.git
    ```
1. Rename the plugin directory:

    ```
    mv mrb-wordpress-plugin-skeleton PLUGIN_NAME_HERE
    ```
1. Rename the base plugin file:
    ```
    mv mrb-wordpress-plugin-skeleton.php PLUGIN_NAME_HERE.php
    ```
1. Install Composer dependencies:

    ```
    composer install
    ```
1. Replace all existing namespace references (`Buzzeasy`) with a new namespace of your choice, e.g. you could replace `Buzzeasy` with `VictoriaHall` if working on Victoria Hall sites


## Custom Post Types
#### To add a new custom post type, you will need to:
1. Add a new class inside `/app/PostTypes` for the post type:
    - You should name it the singular, PascalCased version of the post type, e.g. a post type class for 'property types' would be named `PropertyType`
    - Use one of the existing examples as a base for your class, changing the class name and any config necessary
1. Add your new post types class to the `CustomPostTypes` block in `Core::registerModules` - you should also remove the examples from here

Everything to do with setting up the custom post type is automatic. If you wish to overwrite any of the default values for the post type (eg. name, plural version of name), you can do so by adding any of the following to your post type class:


- CPT name:

    ```
    protected $name = 'cool example with config';
    ```

 - CPT dashicon:

    ```
    protected $icon = 'dashicon-home';
    ```

 - CPT terminology:

    ```
    protected $terms = [
        'post_type_name'    => 'cool-example-with-config',
        'singular'          => 'Cool Example With Config',
        'plural'            => 'Cool Examples With Config',
        'slug'              => 'cool-example-with-config',
    ];
    ```

 - CPT config:

    ```
    protected $config = [
        'show_in_nav_menus' => true,
        'hierarchical'      => false,
        'supports'          => [
            'title',
            'thumbnail',
            'page-attributes',
        ],
        'has_archive'       => false,
    ];
    ```

Note: the default values that are automatically generated are sensible, so it's advisable to leave the settings as they are unless they don't make sense for the project. Additionally, you do not need to provide the entire `$config` and `$terms` arrays, just the key/values you want to overwrite.

#### To add a taxonomy for a custom post type, you will need to:

1. Add a `$taxonomy` property to your post type class. You can either provide an array of taxonomy names (singular):

    ```
    protected $taxonomies = [
        'category',
        'animal',
        'food',
    ];
    ```

    Or if you need to overwrite any of the default terminology (e.g. plural form) you can provide an array of arrays where the taxonomy name is the key:

    ```
     protected $taxonomies = [
        'category' => [
            'plural' => 'categories',
        ],
        'sheep' => [
            'plural' => 'sheep',
        ],
    ];
    ```

#### To set up connections between post types, you will need to:

1. Add a static `$connections` property to your post type class. It should be an array of post type classes you wish to connect your post type to (with their fully qualified namespaces):

    ```
    protected static $connections = [
        \Buzzeasy\App\PostTypes\Animal::class,
        \Buzzeasy\App\PostTypes\Food::class,
    ];
    ```

To use the default connection configuration (recommended unless not appropriate for the project), pass in the class with its fully qualified namespace as the value in the `$connections` array. To override the configuration, use the classname as the array key in `$connections` and use an array of overrides s the value, e.g.

    ```
    protected static $connections = [
        \Buzzeasy\App\PostTypes\Animal::class => [
            'reciprocal' => false,
            'sortable' => false,
        ],
    ];
    ```

Please note you must also activate the `Posts to Posts` plugin for post connections to work.

#### To add custom functions for a post type, you need to:

1. Add a method to the post type class that does what you need it to do, e.g.

    ```
    public function findByPartner($partnerId)
    {
        return $this->whereTaxonomy(['partner' => $partnerId])->orderBy('title')->get();
    }
    ```

## Querying Post Types

You can query post type data for any post type class you have created. You can do so by building up query strings using the `PostTypeQuerier` methods. Any of the methods can be called statically (`::all()`) or chained/dynamically (`->all()`) e.g.

```
ConfigExample::all();
ConfigExample::where(['title' => 'Stuff'])->get();
ConfigExample::limit(10)->where(['post_status' => publish'])->get();
```

### 'Fetching' Methods

Fetching methods will return a query result to you which you can then access data from.

#### `first()` :

This returns the first result only for your query string, e.g.

```
$row = ConfigExample::first();
```

Returns: a WP_Post object where the post type data can be accessed as properties e.g.

```
$row->post_title;
```

#### `find(int $id)` :

When passed an ID of a post/post type, it will return the post with that ID, e.g.

```
ConfigExample::find(4);
```

Returns: a WP_Post object where the post type data can be accessed as properties e.g.

```
echo $row->post_title;
```

#### `all()` :

This returns all results and does not allow use of modifier methods like `where()` or `limit()`, e.g.

```
$all = ConfigExample::all();
```

Returns: an array of WP_Post objects, which can be iterated over, accessing the data as properties, e.g.

```
foreach ($all as $one) {
    echo $one->post_title;
}
```

#### `paginate(int $count)` :

This returns the specified number of results and also enables the default Wordpress pagination. Total pages available can be accessed via the `pages` property, e.g.

```
$paginated = ConfigExample::paginate(20);
echo $paginated->pages;                     // 156
```

Returns: an array of WP_Post objects, which can be iterated over, accessing the data as properties, e.g.

```
foreach ($all as $one) {
    echo $one->post_title;
}
```

#### `get(array $parameters)` :

This returns all results that match your query string, e.g.

```
$rows = ConfigExample::get();
```

Returns: an array of WP_Post objects, which can be iterated over, accessing the data as properties, e.g.

```
foreach ($rows as $one) {
    echo $one->post_title;
}
```

### 'Modifier' Methods

Modifier methods modify the query you are building, but do not return a result. You must chain a 'fetching' method like `get()` to the end to return the query result.

#### `where(array $parameters)` :

This filters the returned data by an array of parameters passed in. Each key in the array should be a column name or valid [WP_Post argument](https://www.billerickson.net/code/wp_query-arguments), and each corresponding value should be the string/integer you want to match it against. If the array contains more than one item, the `where` clauses will be evaluated with the 'AND' operator (i.e. `WHERE title = 'Hello World!' AND post_status = 'publish'`). E.g:

```
ConfigExample::where([
    'title' => 'Hello World!',
    'post_status' => 'publish',
])->get();
```

Returns: a PostTypeQuerier object from which you can chain additional 'fetching' or 'modifier' methods.

#### `whereTaxonomy(array $parameters)` :

This filters the returned data by any taxonomies it belongs to via an array. Each key in the array should be a taxonomy name, and each corresponding value should be the string/integer you want to match it against. If the arry contains more than one item, the `where` clauses will be evaluated with the 'AND' operator (i.e. `WHERE X AND Y`). E.g:
```

ConfigExample::whereTaxonomy([
    'category' => 'animals',
    'post_status' => 'horse',
])->get();
```

Returns: a PostTypeQuerier object from which you can chain additional 'fetching' or 'modifier' methods.

#### `limit(int $limit)` :

Limits the amount of results that will be returned, e.g.

```
ConfigExample::limit(5)->get();
```

Returns: a PostTypeQuerier object from which you can chain additional 'fetching' or 'modifier' methods.

#### `orderBy(string $column, string $direction = 'ASC')` :

This orders the results to be returned by the column name and direction given. Valid directions are 'ASC' (A-Z, 0-9) and 'DESC' (Z-A, 9-0), but 'ASC' will be used as a default. E.g.

```
ConfigExample::orderBy('title', 'ASC')->get();
```

Returns: a PostTypeQuerier object from which you can chain additional 'fetching' or 'modifier' methods.

#### `connected(int $id, string $postType)` :

Returns: any of the given `$postTypes` that have been linked with the post of the `$id` given e.g.

```
ConfigExample::connected(5, 'animals')->get();
```

Returns: a PostTypeQuerier object from which you can chain additional 'fetching' or 'modifier' methods.
