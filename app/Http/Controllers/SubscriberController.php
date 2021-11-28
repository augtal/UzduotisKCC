<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

class SubscriberController extends Controller
{
    private $FILE_PATH = "storage\users\subscribers\subscribers.csv";

    /**
     * Adds users email to subscription file
     *
     * @param Request $request Users Email data as JSON
     * @return void
     */
    public function subscribe(Request $request){
        $input = $request->input();
        
        if(array_key_exists("emailInput", $input)){
            $this->writeToFile($input);
        }
    }

    /**
     * Checks if email exists or writes it to file
     *
     * @param JSON $formInput From data as JSON
     * @return void
     */
    private function writeToFile($formInput){
        $input = $formInput['emailInput'];

        $index = $this->checkIfEmailExists($input);
        // didn't find email
        if($index == false){
            $this->insertEmail($input);
            return true;
        }
        // found email already in the file
        else{

            return false;
        }
    }

    /**
     * Checks if email is already in the file
     *
     * @param string $email Users email adress
     * @return void
     */
    private function checkIfEmailExists($email){
        $csvFilePath = public_path($this->FILE_PATH);

        $reader = Reader::createFromPath($csvFilePath, 'r');
        $reader->setHeaderOffset(0);

        $records = $reader->getRecords();
        foreach ($records as $offset => $record) {
            if($record['Email'] == $email){
                return $offset;
            }
        }
        return false;
    }

    /**
     * Insert new email to the end of csv file
     *
     * @param string $email Users email adress
     * @return void
     */
    private function insertEmail($email){
        $csvFilePath = public_path($this->FILE_PATH);

        $fp = fopen($csvFilePath, 'a');
        fputcsv ($fp, [$email]); 
        fclose($fp);  
    }
}
