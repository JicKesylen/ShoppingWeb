<?php
namespace App\Util;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;

class ApiResponse
{
    public bool $success = false;
    public string $message = "";
    public array $data = array();
    public int $statusCode = 400;
    public int $errorCode = 0;
    public static $currentLang = "";
    private static $langMap = [];
    public function __construct($success = false, $message = "", $errorCode = 0, $statusCode = 400, $data = array())
    {
        $this->success = $success;
        $this->message = self::getLangString($message);
        $this->data = $data;
        $this->statusCode = $success ? 200 : $statusCode;
        $this->errorCode = $errorCode;
    }
    public function toJson($e = null, $url = null)
    {
        if ($e) {
            $this->writeError($e, $url);
        }
        return [
            "success" => $this->success,
            "statusCode" => $this->statusCode,
            "message" => $this->message,
            "data" => $this->data,
            "errorCode" => $this->errorCode
        ];
    }
    private function writeError($error, $url)
    {
        try {
            $arrError = [
                "user_id" => Session::get("userid") ?? "",
            ];
            if ($error instanceof Exception) {
                $arrError["code"] = $error->getCode();
                $arrError["line"] = $error->getLine();
                $arrError["file"] = $url ?? $error->getFile();
                $arrError["message"] = $error->getMessage();
            } else {
                $arrError["message"] = is_array($error) ? json_encode($error) : $error;
            }
            DB::table('error_record')->insert($arrError);
        } catch (Exception $e) {
            // print($e->getMessage());
        }
    }
    public static function setLang($lang)
    {
        if (self::$currentLang != $lang) {
            try {
                self::$currentLang = $lang;
                $loginStr = file_get_contents("../app/Lang/$lang.json");

                self::$langMap = json_decode($loginStr, true);
            } catch (Exception $e) {
            }
        }
    }
    public static function getLangString($strID, ...$params)
    {
        if (isset(self::$langMap[$strID])) {
            if (count($params)>0) {
                return sprintf(self::$langMap[$strID], ...$params);
            }
            return self::$langMap[$strID];
        }
        return $strID;
    }
}
