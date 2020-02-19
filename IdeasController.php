<?php

/**
 * Created by Vlad.
 * User: vlad
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ideas;
use App\Models\Statuses;

/**
 * Class IdeasController
 * @package App\Http\Controllers
 */
class IdeasController extends Controller
{
    use CustomResponse;
    /**
     * instance of class ideas
     *
     * @var object
     */
    private $idea;


    /**
     * Set instance of class ideas to var $idea
     *
     * @return void
     */
    public function __construct() {

        $this->idea = (object) new Ideas();

    }

    /**
     * Get paginate Ideas from db
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return object
     */
    public function paginate(Request $request) :object {

        try {
            $count = $request->count ?? 10;

            $ideas = $this->idea->with("attachment","statuses")->paginate($count)->toArray();

            return $this->successResponse($ideas);

        }catch (\Exception $e){

            return $this->errorResponse($e->getMessage());

        }

    }

    /**
     * create  record in databases
     * @param ValidatedRequest $dataForCreate validated data
     * @return object
     */
    public function create(ValidatedRequest $dataForCreate) :object {
        try {
            $record = $this->create($dataForCreate);
            ($record->id)
                ? $ret = $this->successResponse($record)
                : $ret = $this->errorResponse("Record not created");

            return $ret;

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * Delete Records from db table ideas via API
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Exception if not deleted from databases
     *
     * @return object
     */
    public function drop(Request $request) :object {
        try {

            $delete = $this->idea->delete($request->id);

            if(!isset($delete["id"])) throw new \Exception('Record not deleted');

            return $this->deleteResponse($delete);

        }catch (\Exception $e){

            return $this->errorResponse($e->getMessage());

        }
    }

}