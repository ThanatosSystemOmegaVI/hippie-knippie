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
            // Send mail to customer
            $ontvanger = $_POST['email'];
            $onderwerp = "Bevestiging van uw contactverzoek";
            $bericht = "";
            $bericht .= "Hey" . $_POST['naam'] . ", \n\n";
            $bericht .= "Bedankt voor je contactbericht! We zijn blij dat je ons hebt benaderd.\n";
            $bericht .= "ik heb je bericht ontvangen en zal er mee aan de slag gaan. We begrijpen dat je belangrijke vragen of opmerkingen hebt en ik zal mijn best doen om snel en grondig te reageren.\n";
            $bericht .= "Met vriendelijke groet,\n\n";
            $bericht .= "Eline Verhaar van Hippie Knippie\n\n\n";
            // mail($ontvanger, $onderwerp, $bericht, Controller::$mailingHeaders);

            // send confermation mail to company mail
            $ontvanger =  Controller::$companyMail;
            $onderwerp = $_POST['naam'] . " Heeft zojuist een contact verzoek achtergelaten";
            $bericht = "";
            $bericht .= $_POST['naam'] . " Heeft zojuist een contact verzoek achtergelaten\n";
            $bericht .= " E-mail: " . $_POST['email'] . ", \n";
            $bericht .= " Onderwerp: " . $_POST['onderwerp'] . ", \n";
            $bericht .= " Bericht: " . $_POST['bericht'] . ", \n";
            $bericht .= " Met vriendelijke groet , \n\n";
            $bericht .= "Hippie Knippie automated system, \n\n\n";
            // mail($ontvanger, $onderwerp, $bericht, Controller::$mailingHeaders);

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
