<?php
/**
 * JARIZ.PRO
 * Date: 24/04/2014
 * Time: 10:21
 * Author: JariZ
 */

namespace Admin;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class CrudController
 * Automates the Creating, Reading, Updating and Deleting of models.
 * @package Admin
 * @author Jari Zwarts
 */
class CrudController extends AdminController
{

    /**
     * MUST be overridden by the extender.
     * Should return a array with all required fields.
     * The key is the label, the value is a array with the following required keys:<br>
     * <ul>
     * <li><b>name</b>: The column in the table. (string)</li>
     * <li><b>rules</b>: The validation rules as described in the laravel validator docs. Can be an empty string, but is still required. (string)</li>
     * <li><b>type</b>: The type of field to display. (string)<br>Can be one of the following:
     * <ul>
     * <li><b>text</b>: A input with the text type</li>
     * <li><b>password</b>: A input with the password type. will be ignored unless it's filled in.</li>
     * <li><b>radio</b>: A set of radio boxes. Requires the optional key 'options' as described below.</li>
     * <li><b>wysiwyg</b>: 'What you see is what you get' HTML editor.</li>
     * <li><b>file</b>: A file input. Requires a upload class name to be set.</li>
     * <li><b>date</b>: A text field with a datepicker which allows for easy date choosing.</li>
     * </ul>
     * </ul>
     * Optional keys:
     * <ul>
     * <li><b>hideInOverview</b>: Whether to show the field on the overview page. (boolean)</li>
     * <li><b>options</b>: An array for fields with multiple values such as the radio type. The index is the value, the value is the label. (array) <br>Example: <pre>[0 => 'No', 1 => 'Yes']</pre></li>
     * <li><b>boolean</b>: Whether to show the field as a boolean in the overview. Expects the field's value to be either 0 or 1. (boolean)</li>
     * </ul>
     * @author Jari Zwarts
     */
    protected function getFields()
    {
        return array();
    }

    /**
     * The model name (for example '\\Model\\User'). Must be overridden.
     * @var string
     */
    protected $model;

    /**
     * Plural form of the CRUD entry (for example 'Users'). Must be overridden.
     * @var string
     */
    protected $plural;

    /**
     * Singular form of the CRUD entry (for example 'User'). Must be overridden.
     * @var string
     */
    protected $singular;

    /**
     * The route you assigned in routes.php (for example 'dashboard.users'). Must be overridden.
     * @var string
     */
    protected $route;

    /**
     * Whether to display the timestamps (created_formatted, updated_formatted). Doesn't need to be overridden
     * @var bool
     */
    protected $timestamps = false;

    /**
     * Array with relationships the model has
     * @var array
     */
    protected $with = false;

    /**
     * The name of the upload class that will handle file uploads trough the file field.
     * @var string
     */
    protected $upload = "\\Fairtrade\\Upload";

    /**
     * Indicates if the Model has a order functionality
     * @var bool
     */
    protected $reorder = false;

    /**
     * Returns a new instance of the crud's model
     * @author Jari Zwarts
     * @returns \Eloquent
     */
    public function model() {
        return new $this->model;
    }

    /**
     * Return a array with meta data about the CrudController
     * @author Jari Zwarts
     * @return array
     */
    public function meta() {
        return array(
            "plural" => $this->plural,
            "singular" => $this->singular,
            "upload" => $this->upload,
            "timestamps" => $this->timestamps,
            "route" => $this->route,
            "model " => $this->model,
            "with" => $this->with
        );
    }

    /**
     * Get all fields in the crud controller
     * @author Jari Zwarts
     * @returns array
     */
    public function fields() {
        return $this->getFields();
    }

    /**
     * Give a overview of all entries
     * @author Jari Zwarts
     */
    public function overview($filter=null, $trash=false, $view=false)
    {
        if(!$view)
           $view = "admin.crud.overview";

        \View::share("title", $this->plural." overview");

        //get all fields, filter out the ones that we aren't supposed to display in the overview.
        $fields_ = $this->getFields();
        $fields = array();
        foreach ($fields_ as $key => $field) {
            if (isset($field["hideInOverview"]) && $field["hideInOverview"] === true)
                continue;
            $fields[$key] = $field;
        }

        $model = $this->model;
        $data = new $model;

        if(\Input::has("q")) {
            //Apparently, we're not only showing a overview, we're also searching for a certain value within one of the columns
            //So, let's build a query that filters the data.
            /* @var $data \Eloquent */

            $data = $data->whereNested(function ($query) use ($fields) {
                foreach ($fields as $field) {
                    //search trough all fields that are allowed to display in the overview.
                    if (isset($field["hideInOverview"]) && $field["hideInOverview"] === true)
                        continue;
                    $query->orWhere($field["name"], "LIKE", "%" . \Input::get("q") . "%");
                }
            });
        }


        //don't forget to apply filter
        if (!is_null($filter))
            $data = $data->whereRaw($filter);

        if ($this->with)
            $data->with($this->with);

        if( isset($this->orderBy) && is_array($this->orderBy ) ){
          $data = $data->orderBy( $this->orderBy[0], $this->orderBy[1]);
        }

        //trash?
        if ($trash)
            $data = $data->onlyTrashed();



        //force query to give unique results
        $data = $data->distinct()
            //get the data
            ->paginate(15);


        return \View::make($view)
            ->with("columns", $fields)
            ->with("singular", $this->singular)
            ->with("plural", $this->plural)
            ->with("route", $this->route)
            ->with("data", $data)
            ->with("reorder", $this->reorder)
            ->with("timestamps", $this->timestamps)
            ->with("searchQuery", \Input::get("q"))
            ->with("trash", $trash)
            ->with("with", $this->with);
    }

    /**
     * Display the overview, but only with trashed items
     * @author Jari Zwarts
     */
    public function trash() {
        return $this->overview(null, true);
    }

    /**
     * Show the edit/add form.
     * @param null $id If id is null, we're assuming you want to add a user.
     * @return \Illuminate\View\View
     * @author Jari Zwarts
     */
    public function showEdit($id = null)
    {
        $editing = !is_null($id);
        $fields = $this->getFields();
        $model = $this->model;
        $keys = array();
        $data = array();


        if($editing){
            $data = $model::findOrFail($id)->toArray();
            \View::share("title", "Edit ".strtolower($this->singular));
        }



        foreach ($fields as $key => $field){

            if( $editing && array_key_exists('hide_if', $field)){
                foreach($field['hide_if'] as $col => $value){
                    if( array_key_exists($col, $data) && $data[$col] == $value){
                        unset($fields[$key]);
                        break;
                    }
                }
            }

            if( $editing && $field['type'] == 'json'){
                $meta = json_decode($data[$field['name']]);
                if( is_null( $meta) ){
                    continue;
                }

                foreach( (array)$meta as $key => $json_field){

                    $json_field = (array)$json_field;
                    $name = $json_field['name'] = '__json__'.$key;

                    $fields[$json_field['label']] = $json_field;
                    $data[$name] = $json_field['value'];
                    $keys[] = $name;
                }
            }

            $keys[] = $field["name"];
        }

        if(!$editing){
            $data = \Input::only($keys);
            \View::share("title", "Create a ".strtolower($this->singular));
        }

        return \View::make("admin.crud.edit")
            ->with("fields", $fields)
            ->with("data", $data)
            ->with("post_route", $this->route . "-doedit")
            ->with('editing', $editing)
            ->with("id", $id)
            ->with("singular", $this->singular)
            ->with("route", $this->route);
    }

    /**
     * Do the actual adding/editing.
     * @author Jari Zwarts
     */
    public function edit()
    {
        $model = $this->model;
        //get all fields in the crud
        $fields = $this->getFields();

        //determine if we're adding or editing
        $editing = \Input::has("id");

        //build the input
        $keys = array("id");
        if ($editing){
            $data = $model::findOrFail(\Input::get("id"));
            $dataArray = $data->toArray();
        }
        else $data = new $model;
        foreach ($fields as $field){

            if( $editing && $field['type'] == 'json'){

                if( !array_key_exists($field['name'], $dataArray)){
                    continue;
                }

//                dd($data[$field['name']]);
                $meta = json_decode($data[$field['name']]);
                if( is_null( $meta) ){

                    continue;
                }

                foreach( (array)$meta as $key => $json_field){

                    $json_field = (array)$json_field;
                    $name = $json_field['name'] = '__json__'.$key;

                    $fields[$name] = $json_field;
                    $data[$name] = $json_field['value'];
                    $keys[] = $name;

                }
            }
            $keys[] = $field["name"];
        }
        $input = \Input::only($keys);

        $json = array();

        foreach($input as $field_name => $value){
            if(str_contains($field_name, '__json__')){
                $name = str_replace('__json__', '', $field_name);

               $json[$name] = [
                  'value' =>  $input[$field_name],
                  'type' => $fields[$field_name]['type'],
                  'label' => $fields[$field_name]['label']
               ];
                unset($fields[$field_name]);
                unset($input[$field_name]);
                unset($data[$field_name]);
            }
        }


        //build the rules
        $rules = array();
        foreach ($fields as $field) {

            if($field['type'] == 'json'){
                $input[$field['name']] = json_encode($json);
            }
            if(array_key_exists('rules', $field))
                $rules[$field["name"]] = $field["rules"];
        }

        if ($editing) {
            $m = new $model;
            $rules["id"] = "required|numeric|exists:" . $m->getTable() . ",id";
        }

        //validate the data
        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            \Input::flash();
            \View::share("errors", $validator->errors());
            return $this->showEdit(\Input::get("id"));
        } else {



            foreach ($fields as $field) {
                $name = $field["name"];
                $abort = false;

                //check for exceptions in data
                switch ($field["type"]) {
                    case "password";
                        //if password field is empty, don't change it.
                        if (empty($input[$name]) && $editing)
                            $abort = true;
                        break;
                    case "download":
                        $file = \Input::file($name);
                        if(!is_array($file) && !is_null($file)) {
                            /* @var $v UploadedFile */
                            $validation = \Validator::make(\Input::all(), [
                                $name => ""
                            ]);

                            if($validation->fails()) {
                                \Input::flash();
                                \View::share("errors", $validation->errors());
                                return $this->showEdit(\Input::get("id"));
                            }

                            $final = $file->move("dl", $file->getClientOriginalName());
                            $input[$name] = $final->getBasename();
                        } else $abort = true;
                        break;
                    case 'date':
                        // Makes sure date is correctly formatted before inserting into DB
                        $input[ $name ] = \Date::input( $input[ $name ])->forDatabase();
                        break;
                }

                if(!$abort) $data->$name = $input[$name];
            };
            $data->save();

            return \Redirect::to(\URL::route($this->route));
        }
    }

    /**
     * Delete an item. Will throw an error if the input contains a incorrect id.
     * @return \Illuminate\Http\RedirectResponse
     * @author Jari Zwarts
     */
    public function delete() {
        $model = $this->model;


        $id = intval(\Input::get("id"));
        $entry = $model::findOrFail($id);

        /* Make sure the user can't delete his own account */
        if( $model === '\Model\User' && \Auth::user()->id === $entry->id ){
            return \Redirect::back()
                ->with('error', 'You can\'t delete your own account');
        }

        $entry->delete();
        return \Redirect::back()->with("restore_id", $entry->id);
    }

    /**
     * Restore a deleted item. Will throw an error if the input contains a incorrect id.
     * @return \Illuminate\Http\RedirectResponse
     * @author Jari Zwarts
     */
    public function restore() {
        $model = $this->model;


        /* @var $model \Eloquent */
        $id = intval(\Input::get("id"));
        $entry = $model::onlyTrashed()->findOrFail($id);
        $entry->restore();
        return \Redirect::back();
    }


    public function permDelete(){
        $model = $this->model;
        $id = intval(\Input::get('id') );
        $entry = $model::onlyTrashed()->findOrFail($id);
        $entry->forceDelete();
        return \Redirect::back();
    }
}