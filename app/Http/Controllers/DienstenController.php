<?php

namespace App\Http\Controllers;

use App\Models\Diensten;
use Illuminate\Http\Request;

session_start();

class DienstenController extends Controller
{
    public function getDiensten(Request $request)
    {
        $diensten = Diensten::get();
        if (!empty($diensten)) {
            $diensten = $diensten->toArray();
        } else {
            $diensten = [];
        }

        return response()->json([
            'diensten' => $diensten,
        ]);
    }

    public function addDienst(Request $request)
    {
        $_POST = $request->all();

        // VARS
        $omschrijving = !empty($_POST['omschrijving']) ? $_POST['omschrijving'] : "";

        if (!Diensten::where('naam', $_POST['naam'])->exists()) {
            // insert dienst
            $insert = Diensten::insert(["naam" => ucfirst($_POST['naam']), "prijs" => $_POST['prijs'], "omschrijving" => $omschrijving]);
            if ($insert) {
                return response()->json([
                    'bool' => "true",
                    'message' => $_POST['naam'] . " Dienst succesvol toegevoegd",
                ]);
            } else {
                return response()->json([
                    'bool' => "false",
                    'message' => "Er ging iets mis met het toevoegen van " . $_POST['naam'],
                ]);
            }
        } else {
            // already exists
            return response()->json([
                'bool' => "false",
                'message' => "Er bestaal al een diesnt met de naam: " . $_POST['naam'],
            ]);
        }
    }

    public function editDienst(Request $request)
    {
        $_POST = $request->all();

        // VARS
        $omschrijving = !empty($_POST['omschrijving']) ? $_POST['omschrijving'] : "";

        if (!empty($_POST['id'])) {
            // update ship data
            $update = Diensten::where("id", $_POST['id'])->update(["naam" => $_POST['naam'], "prijs" => $_POST['prijs'], "omschrijving" => $omschrijving]);

            if ($update) {
                return response()->json([
                    'bool' => "true",
                    'message' => $_POST['naam'] . " Dienst succesvol aangepast",
                ]);
            } else {
                return response()->json([
                    'bool' => "false",
                    'message' => "Er ging iets mis met het aanpassen van " . $_POST['naam'],
                ]);
            }

        } else {
            return response()->json([
                'bool' => "false",
                'message' => "Dienst niet gevonden",
            ]);
        }
    }

    public function deleteDienst(Request $request)
    {
        $_POST = $request->all();
        if (!empty($_POST['id'])) {
            $delete = Diensten::where("id", $_POST['id'])->delete();
            if ($delete) {
                return response()->json([
                    'bool' => "true",
                    'message' => $_POST['naam'] . " Dienst succesvol verweijderd",
                ]);
            } else {
                return response()->json([
                    'bool' => "false",
                    'message' => "Er ging iets mis met het verwijderen van " . $_POST['naam'],
                ]);
            }
        } else {
            return response()->json([
                'bool' => "false",
                'message' => "Dienst niet gevonden",
            ]);
        }
    }

}
