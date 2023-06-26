<?php

namespace App\Http\Controllers;

use App\Models\Contactverzoeken;
use Illuminate\Http\Request;

class ContactverzoekenController extends Controller
{
    public function getContactverzoeken(Request $request)
    {
        $contactverzoeken = Contactverzoeken::get();
        if (!empty($contactverzoeken)) {
            $contactverzoeken = $contactverzoeken->toArray();
        } else {
            $contactverzoeken = [];
        }

        return response()->json([
            'contactverzoeken' => $contactverzoeken,
        ]);
    }

    public function addContactVerzoek(Request $request)
    {
        $_POST = $request->all();
        // insert contactverzoek
        $insert = Contactverzoeken::insert(["date" => date("Y-m-d"), "naam" => ucfirst($_POST['naam']), "email" => $_POST['email'], "onderwerp" => $_POST['onderwerp'], "bericht" => $_POST['bericht']]);
        if ($insert) {
            return response()->json([
                'bool' => "true",
                'message' => "Bedankt voor je contact verzoek " . $_POST['naam'],
            ]);
        } else {
            return response()->json([
                'bool' => "false",
                'message' => "Er ging iets mis met het versturen van je contact verzoek",
            ]);
        }
    }
}
