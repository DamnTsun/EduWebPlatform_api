<?php

abstract class Controller {    
    // Holder instance of model class for controller.
    protected $db;


    /**
     * Encodes the given object as JSON and prints it to output.
     * @param value - object to be encoded as JSON.
     */
    protected function printJSON($value) {
        try {
            echo json_encode($value, JSON_HEX_QUOT | JSON_HEX_TAG);
        } catch (Exception $e) {
            return null;
        }
    }
    
    /**
     * Outputs the given string as a JSON string, with 1 attribute: 'message'.
     * @param message - message to be output.
     */
    protected function printMessage($message) {
        $this->printJSON(array('message' => $message));
    }


    // Abstract methods.
    /**
     * Formats records for output.
     * @param records - records to be formatted.
     */
    protected abstract function formatRecords($records);
    /**
     * Validates incoming JSON (for create / modify resource) so that it contains all necessary fields.
     * @param json - the json of the object.
     */
    protected abstract function validateJSON($json);
}