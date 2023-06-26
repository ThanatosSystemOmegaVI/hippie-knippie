<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    static $companyMail = "elinedebbie@gmail.com";
    static $mailingHeaders = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\nFrom: Hippie Knippie <elinedebbie@gmail.com>\r\n";

	public function __construct() {

	}
}
